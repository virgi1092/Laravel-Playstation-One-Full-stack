<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengantaranResource\Pages;
use App\Models\Pengantaran;
use App\Models\Penyewaan;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Section;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\Builder;

class PengantaranResource extends Resource
{
    protected static ?string $model = Pengantaran::class;
    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationLabel = 'Pengantaran';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Data Pengantaran')
                    ->schema([
                        // Info Penyewaan (Read-only)
                        Forms\Components\Placeholder::make('penyewaan_info')
                            ->label('Penyewaan')
                            ->content(function ($record) {
                                if (!$record || !$record->penyewaan) return 'Data tidak tersedia';
                                
                                $penyewaan = $record->penyewaan;
                                $playstations = $penyewaan->detailPenyewaans->map(function ($detail) {
                                    return $detail->playstation->nama_playstation . ' (' . $detail->jumlah . ')';
                                })->implode(', ');
                                
                                return $penyewaan->penyewa->name . ' - ' . $playstations . ' - ' . $penyewaan->tgl_sewa;
                            })
                            ->visible(fn ($context) => $context === 'edit'),

                        Select::make('id_user')
                            ->label('Teknisi')
                            ->options(User::all()->pluck('name', 'id'))
                            ->searchable()
                            ->required(),

                        DatePicker::make('tgl_antar')
                            ->label('Tanggal Antar')
                            ->required()
                            ->disabled(fn ($context) => $context === 'edit'),

                        TextInput::make('alamat_tujuan')
                            ->label('Alamat Tujuan')
                            ->required()
                            ->maxLength(255)
                            ->disabled(fn ($context) => $context === 'edit'),

                        Textarea::make('catatan_teknisi')
                            ->label('Catatan Teknisi')
                            ->rows(3)
                            ->placeholder('Catatan akan diisi oleh teknisi saat pengantaran'),

                        Select::make('status')
                            ->label('Status')
                            ->options([
                                'proses' => 'Proses',
                                'selesai' => 'Selesai',
                            ])
                            ->default('proses')
                            ->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('penyewaan.penyewa.name')
                    ->label('Nama Penyewa')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('penyewaan.no_telpon')
                    ->label('No. Telepon')
                    ->searchable(),

                Tables\Columns\TextColumn::make('alamat_tujuan')
                    ->label('Alamat Tujuan')
                    ->searchable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('tgl_antar')
                    ->label('Tanggal Antar')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('penyewaan.detailPenyewaans')
                ->label('PlayStation')
                ->formatStateUsing(function ($record) {
                    // Pastikan relasi sudah di-load
                    if ($record->penyewaan && $record->penyewaan->detailPenyewaans) {
                        return $record->penyewaan->detailPenyewaans->map(function ($detail) {
                            return $detail->playstation ? 
                                $detail->playstation->nama_playstation . ' (' . $detail->jumlah . ')' : 
                                'PlayStation tidak ditemukan';
                        })->implode(', ');
                    }
                    return '-';
                }),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Teknisi')
                    ->sortable(),

                Tables\Columns\TextColumn::make('catatan_teknisi')
                    ->label('Catatan Teknisi')
                    ->limit(30)
                    ->placeholder('Belum ada catatan'),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn(string $state): string => ucfirst($state))
                    ->color(fn(string $state): string => match ($state) {
                        'proses' => 'warning',
                        'selesai' => 'success',
                        default => 'gray',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'proses' => 'Proses',
                        'selesai' => 'Selesai',
                    ]),

                Tables\Filters\SelectFilter::make('id_user')
                    ->label('Teknisi')
                    ->options(User::all()->pluck('name', 'id')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                
                // Action untuk update status penyewaan ketika pengantaran selesai
                Tables\Actions\Action::make('complete_delivery')
                    ->label('Selesaikan Pengantaran')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record->status === 'proses')
                    ->action(function ($record) {
                        $record->update(['status' => 'selesai']);
                        
                        // Update status penyewaan menjadi 'proses' setelah berhasil diantar
                        $record->penyewaan->update(['status' => 'proses']);
                        
                        // Notification
                        \Filament\Notifications\Notification::make()
                            ->title('Pengantaran berhasil diselesaikan')
                            ->success()
                            ->send();
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getEloquentQuery(): Builder
    {
        // Menampilkan semua pengantaran yang sudah dibuat
        // atau bisa difilter berdasarkan kebutuhan
        return parent::getEloquentQuery()
            ->with(['penyewaan.penyewa', 'penyewaan.detailPenyewaans.playstation', 'user']);
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
            'index' => Pages\ListPengantaran::route('/'),
            // 'create' => Pages\CreatePengantaran::route('/create'), // Dihapus karena otomatis
            'edit' => Pages\EditPengantaran::route('/{record}/edit'),
        ];
    }
}