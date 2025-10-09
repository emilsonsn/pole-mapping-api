<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CharacteristicResource\Pages;
use App\Models\Characteristic;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CharacteristicResource extends Resource
{
    protected static ?string $model = Characteristic::class;

    protected static ?string $label = 'Característica';
    protected static ?string $pluralLabel = 'Características';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';
    protected static ?string $navigationGroup = 'Tabelas Auxiliares';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Nome')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('value')
                ->label('Valor')
                ->required()
                ->maxLength(255),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nome')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('value')->label('Valor')->sortable()->searchable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCharacteristics::route('/'),
            'create' => Pages\CreateCharacteristic::route('/create'),
            'edit' => Pages\EditCharacteristic::route('/{record}/edit'),
        ];
    }
}
