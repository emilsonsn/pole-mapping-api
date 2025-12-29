<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyResource\Pages;
use App\Models\Company;
use App\Traits\MunicipilityPolicy;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CompanyResource extends Resource
{
    use MunicipilityPolicy;

    protected static ?string $model = Company::class;

    protected static ?string $label = 'Empresa';
    protected static ?string $pluralLabel = 'Empresas';

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Razão Social')
                ->required(),

            Forms\Components\TextInput::make('trade_name')
                ->label('Nome Fantasia'),

            Forms\Components\TextInput::make('cnpj')
                ->label('CNPJ')
                ->required(),

            Forms\Components\TextInput::make('email')
                ->label('Email'),

            Forms\Components\TextInput::make('phone')
                ->label('Telefone'),

            Forms\Components\TextInput::make('website')
                ->label('Website'),

            Forms\Components\Select::make('service_mode')
                ->label('Modo de Serviço')
                ->options([
                    'REGISTER' => 'Cadastro',
                    'MAINTENANCE' => 'Manutenção',
                    'REGISTER_MAINTENANCE' => 'Cadastro e Manutenção',
                ])
                ->required(),

            Forms\Components\Section::make('Endereço')
                ->schema([
                    Forms\Components\TextInput::make('address')->label('Logradouro'),
                    Forms\Components\TextInput::make('address_number')->label('Número'),
                    Forms\Components\TextInput::make('address_neighborhood')->label('Bairro'),
                    Forms\Components\TextInput::make('address_city')->label('Cidade'),
                    Forms\Components\TextInput::make('address_state')->label('UF')->maxLength(2),
                    Forms\Components\TextInput::make('address_zipcode')->label('CEP'),
                ])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')
                ->label('Razão Social')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('cnpj')
                ->label('CNPJ')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('email')
                ->label('Email'),
                
            Tables\Columns\TextColumn::make('service_mode')
                ->label('Modo de Serviço')
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
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }
}
