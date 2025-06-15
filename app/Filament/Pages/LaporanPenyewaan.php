<?php

namespace App\Filament\Pages;

use App\Models\Penyewaan;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action as TableAction; // ✅ Ubah ini
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class LaporanPenyewaan extends Page implements HasTable, HasForms
{
    use InteractsWithTable;
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';

    protected static string $view = 'filament.pages.laporan-penyewaan';

    protected static ?string $navigationLabel = 'Laporan Penyewaan';

    protected static ?string $title = 'Laporan Penyewaan';

    protected static ?int $navigationSort = 10;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'tanggal_dari' => now()->startOfMonth()->format('Y-m-d'),
            'tanggal_sampai' => now()->endOfMonth()->format('Y-m-d'),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Filter Laporan')
                    ->schema([
                        DatePicker::make('tanggal_dari')
                            ->label('Tanggal Dari')
                            ->default(now()->startOfMonth())
                            ->required(),
                        DatePicker::make('tanggal_sampai')
                            ->label('Tanggal Sampai')
                            ->default(now()->endOfMonth())
                            ->required(),
                    ])
                    ->columns(2)
            ])
            ->statePath('data');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query($this->getTableQuery())
            ->columns([
                Tables\Columns\TextColumn::make('penyewa.name')
                    ->label('Nama Penyewa')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('no_telpon')
                    ->label('No. Telepon')
                    ->searchable(),

                Tables\Columns\TextColumn::make('playstation_names')
                    ->label('PlayStation')
                    ->getStateUsing(function ($record) {
                        return $record->detailPenyewaans
                            ->map(fn($detail) => $detail->playstation->nama_playstation)
                            ->implode(', ');
                    })
                    ->wrap(),

                Tables\Columns\TextColumn::make('tgl_sewa')
                    ->label('Tanggal Sewa')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('tgl_kembali')
                    ->label('Tanggal Kembali')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('jumlah')
                    ->label('Jumlah')
                    ->getStateUsing(fn($record) => $record->detailPenyewaans->sum('jumlah'))
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('total_harga')
                    ->label('Total Harga')
                    ->getStateUsing(fn($record) => $record->detailPenyewaans->sum('total_harga'))
                    ->money('IDR')
                    ->alignEnd(),

                Tables\Columns\TextColumn::make('metode_bayar')
                    ->label('Metode Pembayaran')
                    ->getStateUsing(function ($record) {
                        $pembayaran = $record->pembayaran->first();
                        return $pembayaran ? ucfirst($pembayaran->metode_bayar) : '-';
                    })
                    ->badge()
                    ->color(fn (string $state): string => match (strtolower($state)) {
                        'Tunai' => 'success',
                        'E-Wallet' => 'info',
                        'Transfer' => 'warning',
                        default => 'gray',
                    }),
            ])
            ->defaultSort('tgl_sewa', 'desc')
            ->paginated([10, 25, 50, 100])
            ->searchable()
            ->headerActions([
                TableAction::make('filter') // ✅ Ubah dari Action ke TableAction
                    ->label('Filter Data')
                    ->icon('heroicon-o-funnel')
                    ->form([
                        DatePicker::make('tanggal_dari')
                            ->label('Tanggal Dari')
                            ->default($this->data['tanggal_dari'] ?? null),
                        DatePicker::make('tanggal_sampai')
                            ->label('Tanggal Sampai')
                            ->default($this->data['tanggal_sampai'] ?? null),
                    ])
                    ->action(function (array $data): void {
                        $this->data = $data;
                        $this->resetTable();
                    }),

                TableAction::make('exportPdf') // ✅ Ubah dari Action ke TableAction
                    ->label('Export PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('success')
                    ->action(function () {
                        return $this->exportToPdf();
                    }),
            ]);
    }

    protected function getTableQuery(): Builder
    {
        $query = Penyewaan::query()
            ->whereHas('pembayaran', function ($query) {
                $query->where('status', 'selesai');
            })
            ->with([
                'penyewa',
                'detailPenyewaans.playstation',
                'pembayaran' => function ($query) {
                    $query->where('status', 'selesai');
                },
            ]);

        // Apply date filters
        if (!empty($this->data['tanggal_dari'])) {
            $query->whereDate('tgl_sewa', '>=', $this->data['tanggal_dari']);
        }

        if (!empty($this->data['tanggal_sampai'])) {
            $query->whereDate('tgl_sewa', '<=', $this->data['tanggal_sampai']);
        }

        return $query;
    }

    public function exportToPdf()
    {
        try {
            $data = $this->getTableQuery()->get();
            
            if ($data->isEmpty()) {
                Notification::make()
                    ->title('Tidak Ada Data')
                    ->body('Tidak ada data untuk periode yang dipilih.')
                    ->warning()
                    ->send();
                return;
            }

            $tanggalDari = $this->data['tanggal_dari'] ? Carbon::parse($this->data['tanggal_dari'])->format('d/m/Y') : 'Semua';
            $tanggalSampai = $this->data['tanggal_sampai'] ? Carbon::parse($this->data['tanggal_sampai'])->format('d/m/Y') : 'Semua';
            
            $totalPendapatan = $data->sum(function ($penyewaan) {
                return $penyewaan->detailPenyewaans->sum('total_harga');
            });

            $pdf = Pdf::loadView('pdf.laporan-penyewaan', [
                'data' => $data,
                'tanggal_dari' => $tanggalDari,
                'tanggal_sampai' => $tanggalSampai,
                'total_pendapatan' => $totalPendapatan,
                'tanggal_cetak' => now()->format('d/m/Y H:i:s'),
            ]);

            $filename = 'laporan-penyewaan-' . now()->format('Y-m-d-H-i-s') . '.pdf';

            Notification::make()
                ->title('Export Berhasil')
                ->body('Laporan PDF berhasil dibuat.')
                ->success()
                ->send();

            return response()->streamDownload(
                fn () => print($pdf->output()),
                $filename,
                ['Content-Type' => 'application/pdf']
            );

        } catch (\Exception $e) {
            Notification::make()
                ->title('Export Gagal')
                ->body('Terjadi kesalahan: ' . $e->getMessage())
                ->danger()
                ->send();
        }
    }
}