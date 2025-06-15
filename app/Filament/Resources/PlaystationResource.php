<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlaystationResource\Pages;
use App\Filament\Resources\PlaystationResource\RelationManagers;
use App\Models\Playstation;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;




class PlaystationResource extends Resource
{
    protected static ?string $model = Playstation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_playstation')
                    ->required()
                    ->maxLength(255),
                Select::make('jenis')
                    ->options([
                        'PS3' => 'PS3',
                        'PS4' => 'PS4',
                    ]),
                TextInput::make('harga_sewa_harian')
                    ->required()
                    ->maxLength(255),
                TextInput::make('stok')
                    ->required()
                    ->maxLength(255),
                FileUpload::make('foto_playstation')
                    ->required()
                    ->image(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_playstation')
                ->searchable(),
                TextColumn::make('jenis'),
                TextColumn::make('harga_sewa_harian'),
                TextColumn::make('stok'),
                ImageColumn::make('foto_playstation') 
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListPlaystations::route('/'),
            'create' => Pages\CreatePlaystation::route('/create'),
            'edit' => Pages\EditPlaystation::route('/{record}/edit'),
        ];
    }
}
