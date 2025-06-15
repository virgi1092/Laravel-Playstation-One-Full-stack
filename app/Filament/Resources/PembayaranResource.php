<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PembayaranResource\Pages;
use App\Models\Pembayaran;
use App\Models\Penyewaan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;

class PembayaranResource extends Resource
{
    protected static ?string $model = Pembayaran::class;
    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationLabel = 'Pembayaran';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Pembayaran')
                    ->schema([
                        TextInput::make('pby_id')
                            ->label('ID Pembayaran')
                            ->disabled()
                            ->default(fn() => Pembayaran::generateUniquePbyId())
                            ->dehydrated(),

                        Select::make('id_penyewaan')
                            ->label('Penyewaan')
                            ->options(function () {
                                return Penyewaan::where('status', 'pinjam')
                                    ->with(['penyewa', 'detailPenyewaans.playstation'])
                                    ->get()
                                    ->mapWithKeys(function ($penyewaan) {
                                        $totalHarga = $penyewaan->detailPenyewaans->sum('total_harga');
                                        $playstations = $penyewaan->detailPenyewaans->map(function ($detail) {
                                            return $detail->playstation->nama_playstation . ' (' . $detail->jumlah . ')';
                                        })->implode(', ');

                                        return [$penyewaan->id => $penyewaan->penyewa->name . ' - ' . $playstations . ' - Rp' . number_format($totalHarga)];
                                    });
                            })
                            ->searchable()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, Set $set) {
                                if ($state) {
                                    $penyewaan = Penyewaan::with(['penyewa', 'detailPenyewaans.playstation'])->find($state);
                                    if ($penyewaan) {
                                        $totalHarga = $penyewaan->detailPenyewaans->sum('total_harga');
                                        $set('jumlah_bayar', $totalHarga);
                                    }
                                }
                            })
                            ->helperText('Hanya menampilkan penyewaan dengan status "pinjam"'),
                    ])->columns(2),

                Section::make('Detail Penyewaan')
                    ->schema([
                        Placeholder::make('nama_penyewa_display')
                            ->label('Nama Penyewa')
                            ->content(function (Get $get) {
                                $penyewaanId = $get('id_penyewaan');
                                if ($penyewaanId) {
                                    $penyewaan = Penyewaan::with('penyewa')->find($penyewaanId);
                                    return $penyewaan ? $penyewaan->penyewa->name : '-';
                                }
                                return '-';
                            }),

                        Placeholder::make('detail_playstation')
                            ->label('Detail PlayStation')
                            ->content(function (Get $get) {
                                $penyewaanId = $get('id_penyewaan');
                                if ($penyewaanId) {
                                    $penyewaan = Penyewaan::with('detailPenyewaans.playstation')->find($penyewaanId);
                                    if ($penyewaan) {
                                        $details = $penyewaan->detailPenyewaans->map(function ($detail) {
                                            $stokTersedia = $detail->playstation->stok;
                                            $statusStok = $stokTersedia >= $detail->jumlah ? '✅' : '❌';
                                            
                                            return $detail->playstation->nama_playstation .
                                                ' - Jumlah: ' . $detail->jumlah .
                                                ' - Durasi: ' . $detail->durasi_sewa . ' hari' .
                                                ' - Subtotal: Rp' . number_format($detail->total_harga) .
                                                ' - Stok: ' . $stokTersedia . ' ' . $statusStok;
                                        })->implode('<br>');
                                        return new \Illuminate\Support\HtmlString($details);
                                    }
                                }
                                return '-';
                            }),

                        Placeholder::make('total_harga_display')
                            ->label('Total Harga')
                            ->content(function (Get $get) {
                                $penyewaanId = $get('id_penyewaan');
                                if ($penyewaanId) {
                                    $penyewaan = Penyewaan::with('detailPenyewaans')->find($penyewaanId);
                                    if ($penyewaan) {
                                        $total = $penyewaan->detailPenyewaans->sum('total_harga');
                                        return 'Rp ' . number_format($total);
                                    }
                                }
                                return '-';
                            }),

                        Placeholder::make('tanggal_kembali_display')
                            ->label('Tanggal Kembali')
                            ->content(function (Get $get) {
                                $penyewaanId = $get('id_penyewaan');
                                if ($penyewaanId) {
                                    $penyewaan = Penyewaan::find($penyewaanId);
                                    return $penyewaan ? $penyewaan->tgl_kembali->format('d/m/Y') : '-';
                                }
                                return '-';
                            }),

                        Placeholder::make('stock_warning')
                            ->label('Peringatan Stok')
                            ->content(function (Get $get) {
                                $penyewaanId = $get('id_penyewaan');
                                if ($penyewaanId) {
                                    $penyewaan = Penyewaan::with('detailPenyewaans.playstation')->find($penyewaanId);
                                    if ($penyewaan) {
                                        $warnings = [];
                                        foreach ($penyewaan->detailPenyewaans as $detail) {
                                            if ($detail->playstation->stok < $detail->jumlah) {
                                                $warnings[] = "⚠️ Stok {$detail->playstation->nama_playstation} tidak mencukupi! (Tersedia: {$detail->playstation->stok}, Dibutuhkan: {$detail->jumlah})";
                                            }
                                        }
                                        return $warnings ? new \Illuminate\Support\HtmlString('<div style="color: red;">' . implode('<br>', $warnings) . '</div>') : '✅ Semua stok mencukupi';
                                    }
                                }
                                return '-';
                            }),
                    ])->columns(2),

                Section::make('Pembayaran')
                    ->schema([
                        Select::make('metode_bayar')
                            ->label('Metode Pembayaran')
                            ->options([
                                'Tunai' => 'Tunai',
                                'E-Wallet' => 'E-Wallet',
                                'Transfer' => 'Transfer Bank',
                            ])
                            ->required(),

                        TextInput::make('jumlah_bayar')
                            ->label('Total Bayar')
                            ->prefix('Rp')
                            ->numeric()
                            ->required()
                            ->rules([
                                function (Get $get) {
                                    return function (string $attribute, $value, \Closure $fail) use ($get) {
                                        $penyewaanId = $get('id_penyewaan');
                                        if ($penyewaanId) {
                                            $penyewaan = Penyewaan::with('detailPenyewaans')->find($penyewaanId);
                                            if ($penyewaan) {
                                                $totalHarga = $penyewaan->detailPenyewaans->sum('total_harga');
                                                if ($value < $totalHarga) {
                                                    $fail('Jumlah bayar tidak boleh kurang dari total harga (Rp' . number_format($totalHarga) . ')');
                                                }
                                            }
                                        }
                                    };
                                },
                            ]),

                        Toggle::make('is_paid')
                            ->label('Sudah Dibayar')
                            ->default(false)
                            ->reactive()
                            ->afterStateUpdated(function ($state, Set $set) {
                                // Jika toggle diaktifkan, set status ke selesai
                                if ($state) {
                                    $set('status', 'selesai');
                                } else {
                                    $set('status', 'pending');
                                }
                            }),

                        Select::make('status')
                            ->label('Status Pembayaran')
                            ->options([
                                'pending' => 'Pending',
                                'selesai' => 'Selesai',
                            ])
                            ->default('pending')
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, Set $set) {
                                // Sinkronisasi dengan toggle is_paid
                                $set('is_paid', $state === 'selesai');
                            })
                            ->helperText('Status "Selesai" akan mengubah status penyewaan dan mengelola stok PlayStation'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pby_id')
                    ->label('ID Pembayaran')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('penyewaan.penyewa.name')
                    ->label('Nama Penyewa')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('penyewaan.detailPenyewaans')
                    ->label('PlayStation')
                    ->formatStateUsing(function ($record) {
                        return $record->penyewaan->detailPenyewaans->map(function ($detail) {
                            return $detail->playstation->nama_playstation . ' (' . $detail->jumlah . ')';
                        })->implode(', ');
                    }),

                Tables\Columns\TextColumn::make('total_harga_penyewaan')
                    ->label('Total Harga')
                    ->money('IDR')
                    ->getStateUsing(function ($record) {
                        return $record->penyewaan->detailPenyewaans->sum('total_harga');
                    }),

                Tables\Columns\TextColumn::make('jumlah_bayar')
                    ->label('Jumlah Bayar')
                    ->money('IDR'),

                Tables\Columns\TextColumn::make('metode_bayar')
                    ->label('Metode')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Tunai' => 'success',
                        'E-Wallet' => 'warning',
                        'Transfer' => 'primary',
                    }),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'selesai' => 'success',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('penyewaan.status')
                    ->label('Status Penyewaan')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pinjam' => 'gray',
                        'proses' => 'warning',
                        'kembali' => 'success',
                        'selesai' => 'danger',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'selesai' => 'Selesai',
                    ]),

                Tables\Filters\SelectFilter::make('metode_bayar')
                    ->label('Metode Pembayaran')
                    ->options([
                        'Tunai' => 'Tunai',
                        'E-Wallet' => 'E-Wallet',
                        'Transfer' => 'Transfer Bank',
                    ]),

                Tables\Filters\SelectFilter::make('penyewaan.status')
                    ->label('Status Penyewaan')
                    ->options([
                        'pinjam' => 'Pinjam',
                        'proses' => 'Proses',
                        'kembali' => 'Kembali',
                        'selesai' => 'Selesai',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\Action::make('complete_payment')
                    ->label('Selesaikan Pembayaran')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn($record) => $record->status === 'pending')
                    ->requiresConfirmation()
                    ->modalHeading('Selesaikan Pembayaran')
                    ->modalDescription('Apakah Anda yakin ingin menyelesaikan pembayaran ini? Tindakan ini akan mengubah status penyewaan dan mengelola stok PlayStation.')
                    ->action(function ($record) {
                        try {
                            $record->update([
                                'status' => 'selesai',
                                'is_paid' => true
                            ]);
                            
                            Notification::make()
                                ->title('Pembayaran berhasil diselesaikan')
                                ->success()
                                ->send();
                        } catch (\Exception $e) {
                            Notification::make()
                                ->title('Gagal menyelesaikan pembayaran')
                                ->body($e->getMessage())
                                ->danger()
                                ->send();
                        }
                    }),
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
            'index' => Pages\ListPembayarans::route('/'),
            'create' => Pages\CreatePembayaran::route('/create'),
            'edit' => Pages\EditPembayaran::route('/{record}/edit'),
        ];
    }
}