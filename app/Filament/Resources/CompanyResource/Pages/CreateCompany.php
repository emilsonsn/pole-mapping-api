<?php

namespace App\Filament\Resources\CompanyResource\Pages;

use App\Filament\Resources\CompanyResource;
use Filament\Resources\Pages\CreateRecord;
use App\Enums\UserTypeEnum;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\DefaultMail;

class CreateCompany extends CreateRecord
{
    protected static string $resource = CompanyResource::class;

    protected function afterCreate(): void
    {
        $municipality = $this->record;
        $loggedUser = auth()->user();

        $password = Str::random(10);
        $user = User::create([
            'name' => $municipality->name,
            'username' => Str::slug($municipality->name) . rand(100,999),
            'email' => $municipality->email,
            'password' => Hash::make($password),
            'type' => UserTypeEnum::Company,
            'municipality_id' => $loggedUser->municipality_id,
        ]);
        
        Mail::to($municipality->email)->send(
            new DefaultMail(
                'Credenciais de Acesso',
                "Usuário: {$user->username}\nSenha: {$password}",
            )
        );
    }       
}
