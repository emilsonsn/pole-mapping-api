<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PowerResource\Pages;
use App\Models\Power;
use App\Traits\CompanyPolicy;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PowerResource extends Resource
{
    use CompanyPolicy;

    protected static ?string $model = Power::class;

    protected static ?string $label = 'Potência';
    protected static ?string $pluralLabel = 'Potências';
    protected static ?string $navigationIcon = 'heroicon-o-bolt';
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
            'index' => Pages\ListPowers::route('/'),
            'create' => Pages\CreatePower::route('/create'),
            'edit' => Pages\EditPower::route('/{record}/edit'),
        ];
    }
}
