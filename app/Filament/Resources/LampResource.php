<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LampResource\Pages;
use App\Models\Lamp;
use App\Traits\CompanyPolicy;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class LampResource extends Resource
{
    use CompanyPolicy;
    
    protected static ?string $model = Lamp::class;

    protected static ?string $label = 'Lâmpada';
    protected static ?string $pluralLabel = 'Lâmpadas';
    protected static ?string $navigationIcon = 'heroicon-o-light-bulb';
    protected static ?string $navigationGroup = 'Tabelas Auxiliares';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->label('Nome')->required()->maxLength(255),
            Forms\Components\TextInput::make('value')->label('Valor')->required()->maxLength(255),
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
            'index' => Pages\ListLamps::route('/'),
            'create' => Pages\CreateLamp::route('/create'),
            'edit' => Pages\EditLamp::route('/{record}/edit'),
        ];
    }
}
