<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenyewaanResource\Pages;
use App\Models\Penyewaan;
use App\Models\Penyewa;
use App\Models\Playstation;
use App\Models\DetailPenyewaan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Carbon\Carbon;

class PenyewaanResource extends Resource
{
    protected static ?string $model = Penyewaan::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationLabel = 'Penyewaan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Data Penyewa')
                    ->schema([
                        Select::make('id_penyewa')
                            ->label('Nama Penyewa')
                            ->options(Penyewa::all()->pluck('name', 'id'))
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, Set $set) {
                                if ($state) {
                                    $penyewa = Penyewa::find($state);
                                    // Bisa set data tambahan jika diperlukan
                                }
                            }),

                        TextInput::make('alamat')
                            ->label('Alamat')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('no_telpon')
                            ->label('No. Telepon')
                            ->required()
                            ->tel()
                            ->maxLength(20),

                        Textarea::make('ulasan')
                            ->label('Ulasan/Catatan')
                            ->rows(3),
                    ])->columns(2),

                Section::make('Data Jaminan')
                    ->schema([
                        Select::make('jaminan')
                            ->label('Pilihan Jaminan')
                            ->options([
                                'ktp' => 'KTP',
                                'sim' => 'SIM',
                                'stnk' => 'STNK',
                                'ijazah' => 'Ijazah',
                            ])
                            ->required(),

                        FileUpload::make('foto_jaminan')
                            ->label('Foto Jaminan')
                            ->image()
                            ->required()
                            ->directory('jaminan')
                            ->visibility('private'),
                    ])->columns(2),

                Section::make('Data Sewa')
                    ->schema([
                        DatePicker::make('tgl_sewa')
                            ->label('Tanggal Sewa')
                            ->required()
                            ->default(now())
                            ->reactive()
                            ->afterStateUpdated(function ($state, Set $set, Get $get) {
                                $durasi = $get('detail_penyewaans.0.durasi_sewa');
                                if ($state && $durasi) {
                                    $tglKembali = Carbon::parse($state)->addDays($durasi);
                                    $set('tgl_kembali', $tglKembali->format('Y-m-d'));
                                }
                            }),

                        DatePicker::make('tgl_kembali')
                            ->label('Tanggal Kembali')
                            ->disabled()
                            ->dehydrated(),

                        DatePicker::make('tgl_pesan')
                            ->label('Tanggal Pesan')
                            ->default(now())
                            ->required(),
                    ])->columns(3),

                Section::make('Detail Penyewaan PlayStation')
                    ->schema([
                        Repeater::make('detailPenyewaans')
                            ->relationship()
                            ->schema([
                                Select::make('id_playstation')
                                    ->label('PlayStation')
                                    ->options(function () {
                                        return Playstation::where('stok', '>', 0)
                                            ->get()
                                            ->mapWithKeys(function ($ps) {
                                                return [$ps->id => $ps->nama_playstation . ' - Stok: ' . $ps->stok . ' - Rp' . number_format($ps->harga_sewa_harian)];
                                            });
                                    })
                                    ->searchable()
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, Set $set, Get $get) {
                                        if ($state) {
                                            $playstation = Playstation::find($state);
                                            if ($playstation) {
                                                $jumlah = $get('jumlah') ?: 1;
                                                $durasi = $get('durasi_sewa') ?: 1;
                                                $total = $jumlah * $durasi * $playstation->harga_sewa_harian;
                                                $set('total_harga', $total);

                                                // Update tanggal kembali di parent form
                                                $tglSewa = $get('../../tgl_sewa');
                                                if ($tglSewa && $durasi) {
                                                    $tglKembali = Carbon::parse($tglSewa)->addDays($durasi);
                                                    $set('../../tgl_kembali', $tglKembali->format('Y-m-d'));
                                                }
                                            }
                                        }
                                    }),

                                TextInput::make('jumlah')
                                    ->label('Jumlah')
                                    ->numeric()
                                    ->default(1)
                                    ->minValue(1)
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, Set $set, Get $get) {
                                        $playstation = Playstation::find($get('id_playstation'));
                                        if ($playstation && $state) {
                                            $durasi = $get('durasi_sewa') ?: 1;
                                            $total = $state * $durasi * $playstation->harga_sewa_harian;
                                            $set('total_harga', $total);
                                        }
                                    }),

                                TextInput::make('durasi_sewa')
                                    ->label('Durasi Sewa (Hari)')
                                    ->numeric()
                                    ->default(1)
                                    ->minValue(1)
                                    ->required()
                                    ->reactive()
                                    ->afterStateUpdated(function ($state, Set $set, Get $get) {
                                        $playstation = Playstation::find($get('id_playstation'));
                                        if ($playstation && $state) {
                                            $jumlah = $get('jumlah') ?: 1;
                                            $total = $jumlah * $state * $playstation->harga_sewa_harian;
                                            $set('total_harga', $total);

                                            // Update tanggal kembali di parent form
                                            $tglSewa = $get('../../tgl_sewa');
                                            if ($tglSewa) {
                                                $tglKembali = Carbon::parse($tglSewa)->addDays($state);
                                                $set('../../tgl_kembali', $tglKembali->format('Y-m-d'));
                                            }
                                        }
                                    }),

                                TextInput::make('total_harga')
                                    ->label('Total Harga')
                                    ->prefix('Rp')
                                    ->disabled()
                                    ->dehydrated(),
                            ])
                            ->columns(4)
                            ->minItems(1)
                            ->maxItems(5)
                            ->addActionLabel('Tambah PlayStation')
                            ->deleteAction(
                                fn($action) => $action->requiresConfirmation()
                            ),
                    ]),

                // Ganti Hidden::make('status') dengan Select::make('status')
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'pinjam' => 'Pinjam',
                        'proses' => 'Proses',
                        'kembali' => 'Kembali',
                        'selesai' => 'Selesai',
                    ])
                    ->default('pinjam')
                    ->required(),
            ]);
    }

    // Update bagian table() di PenyewaanResource.php

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('penyewa.name')
                    ->label('Nama Penyewa')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tgl_sewa')
                    ->label('Tanggal Sewa')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tgl_kembali')
                    ->label('Tanggal Kembali')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => ucfirst($state))
                    ->color(fn(string $state): string => match ($state) {
                        'pinjam' => 'warning',
                        'proses' => 'primary',
                        'kembali' => 'success',
                        'selesai' => 'danger',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('detailPenyewaans')
                    ->label('PlayStation')
                    ->formatStateUsing(function ($record) {
                        return $record->detailPenyewaans->map(function ($detail) {
                            return $detail->playstation->nama_playstation . ' (' . $detail->jumlah . ')';
                        })->implode(', ');
                    }),

                Tables\Columns\TextColumn::make('total_keseluruhan')
                    ->label('Total')
                    ->money('IDR')
                    ->getStateUsing(function ($record) {
                        return $record->detailPenyewaans->sum('total_harga');
                    }),
            ])
            ->filters([
                // Update filter untuk menambah status 'selesai'
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pinjam' => 'Pinjam',
                        'proses' => 'Proses',
                        'kembali' => 'Kembali',
                        'selesai' => 'Selesai', // Tambah opsi selesai
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPenyewaan::route('/'),
            'create' => Pages\CreatePenyewaan::route('/create'),
            'edit' => Pages\EditPenyewaan::route('/{record}/edit'),
        ];
    }
}
