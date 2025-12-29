<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReactorResource\Pages;
use App\Models\Reactor;
use App\Traits\AdminPolicy;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ReactorResource extends Resource
{
    use AdminPolicy;

    protected static ?string $model = Reactor::class;

    protected static ?string $label = 'Reator';
    protected static ?string $pluralLabel = 'Reatores';
    protected static ?string $navigationIcon = 'heroicon-o-cog-8-tooth';
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
            'index' => Pages\ListReactors::route('/'),
            'create' => Pages\CreateReactor::route('/create'),
            'edit' => Pages\EditReactor::route('/{record}/edit'),
        ];
    }
}
