<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MunicipalityResource\Pages;
use App\Models\Municipality;
use App\Traits\AdminPolicy;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MunicipalityResource extends Resource
{
    use AdminPolicy;

    protected static ?string $model = Municipality::class;

    protected static ?string $label = 'Prefeitura';
    protected static ?string $pluralLabel = 'Prefeituras';

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Nome da Prefeitura')
                ->required(),

            Forms\Components\TextInput::make('cnpj')
                ->label('CNPJ')
                ->required(),

            Forms\Components\TextInput::make('state')
                ->label('UF')
                ->required()
                ->maxLength(2),

            Forms\Components\TextInput::make('ibge_code')
                ->label('Código IBGE')
                ->required(),

            Forms\Components\TextInput::make('email')->label('Email'),
            Forms\Components\TextInput::make('phone')->label('Telefone'),
            Forms\Components\TextInput::make('website')->label('Website'),

            Forms\Components\Section::make('Endereço')
                ->schema([
                    Forms\Components\TextInput::make('address')->label('Logradouro'),
                    Forms\Components\TextInput::make('address_number')->label('Número'),
                    Forms\Components\TextInput::make('address_neighborhood')->label('Bairro'),
                    Forms\Components\TextInput::make('address_zipcode')->label('CEP'),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')
                ->label('Prefeitura')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('cnpj')
                ->label('CNPJ')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('state')
                ->label('UF')
                ->sortable(),
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
            'index' => Pages\ListMunicipalities::route('/'),
            'create' => Pages\CreateMunicipality::route('/create'),
            'edit' => Pages\EditMunicipality::route('/{record}/edit'),
        ];
    }
}
