<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use App\Traits\CompanyPolicy;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UserResource extends Resource
{
    use CompanyPolicy;

    protected static ?string $model = User::class;
    protected static ?string $label = 'Usuário';
    protected static ?string $pluralLabel = 'Usuários';
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'Administração';

    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()?->type === \App\Enums\UserTypeEnum::Company;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Hidden::make('holder_id'),
            Forms\Components\Hidden::make('holder_type'),
            Forms\Components\Hidden::make('type'),

            Forms\Components\TextInput::make('name')->label('Nome')->required(),
            Forms\Components\TextInput::make('username')->label('Usuário')->required()->unique(ignoreRecord: true),
            Forms\Components\TextInput::make('email')->label('E-mail')->email()->required()->unique(ignoreRecord: true),
            Forms\Components\TextInput::make('password')
                ->label('Senha')
                ->password()
                ->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null)
                ->required(fn (string $context) => $context === 'create'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function ($query) {
                $company = auth()->user()->holder;

                return $query->where('holder_id', $company->id)
                            ->where('holder_type', get_class($company));
            })
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('username'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
            ]);
    }


    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
