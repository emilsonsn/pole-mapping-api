<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RelayResource\Pages;

use App\Models\Relay;
use App\Traits\AdminPolicy;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;

class RelayResource extends Resource
{
    use AdminPolicy;

    protected static ?string $model = Relay::class;

    protected static ?string $navigationIcon = 'heroicon-o-bolt';
    protected static ?string $navigationLabel = 'Tipo de Relê';
    protected static ?string $pluralModelLabel = 'Tipos de Relês';
    protected static ?string $navigationGroup = 'Tabelas Auxiliares';
    protected static ?string $modelLabel = 'Relê';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('value')->sortable(),
                Tables\Columns\TextColumn::make('poles_count')
                    ->counts('poles')
                    ->label('Postes'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRelays::route('/'),
            'create' => Pages\CreateRelay::route('/create'),
            'edit' => Pages\EditRelay::route('/{record}/edit'),
        ];
    }
}
