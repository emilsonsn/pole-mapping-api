<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConnectionTypeResource\Pages;
use App\Filament\Resources\ConnectionTypeResource\RelationManagers;
use App\Models\ConnectionType;
use App\Traits\CompanyPolicy;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ConnectionTypeResource extends Resource
{
    use CompanyPolicy;

    protected static ?string $model = ConnectionType::class;
    protected static ?string $label = 'Tipo de conexão';
    protected static ?string $pluralLabel = 'Tipos de conexão';

    protected static ?string $navigationIcon = 'heroicon-o-link';
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
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('value')
                    ->label('Valor')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListConnectionTypes::route('/'),
            'create' => Pages\CreateConnectionType::route('/create'),
            'edit' => Pages\EditConnectionType::route('/{record}/edit'),
        ];
    }
}
