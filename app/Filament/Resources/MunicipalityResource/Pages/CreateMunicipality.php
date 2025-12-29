<?php

namespace App\Filament\Resources\MunicipalityResource\Pages;

use App\Filament\Resources\MunicipalityResource;
use Filament\Resources\Pages\CreateRecord;
use App\Enums\UserTypeEnum;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\DefaultMail;
use Illuminate\Support\Facades\DB;

class CreateMunicipality extends CreateRecord
{
    protected static string $resource = MunicipalityResource::class;

    protected function afterSave(): void
    {
        $municipality = $this->record;

        $password = Str::random(10);
        $user = User::create([
            'name' => $municipality->name,
            'username' => Str::slug($municipality->name) . rand(100,999),
            'email' => $municipality->email,
            'password' => Hash::make($password),
            'type' => UserTypeEnum::CityHall,
            'municipality_id' => $municipality->id,
        ]);

        Mail::to($municipality->email)->send(
            new DefaultMail(
                'Credenciais de Acesso',
                "Usuário: {$user->username}\nSenha: {$password}",
            )
        );
    }    
}
