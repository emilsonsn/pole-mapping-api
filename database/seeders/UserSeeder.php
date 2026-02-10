<?php

namespace Database\Seeders;

use App\Enums\UserTypeEnum;
use App\Models\Company;
use App\Models\Municipality;
use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $municipality = Municipality::first() ?? Municipality::factory()->create();

        Company::first() ?? Company::factory()->create([
            'municipality_id' => $municipality->id,
        ]);

        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'type' => UserTypeEnum::Admin,
                'username' => 'admin',
                'password' => Hash::make('admin')
            ],
            [
                'name' => 'Prefeitura',
                'email' => 'prefeitura@prefeitura.com',
                'type' => UserTypeEnum::CityHall,
                'username' => 'prefeitura',
                'password' => Hash::make('prefeitura'),
                'municipality_id' => $municipality->id        
            ],
            [
                'name' => 'Empresa',
                'email' => 'empresa@empresa.com',
                'type' => UserTypeEnum::Company,
                'username' => 'empresa',
                'password' => Hash::make('empresa'),
                'municipality_id' => $municipality->id
            ],
            [
                'name' => 'Técnico',
                'email' => 'tecnico@tecnico.com',
                'type' => UserTypeEnum::User,
                'username' => 'tecnico',
                'password' => Hash::make('tecnico'),
                'municipality_id' => $municipality->id
            ],
        ];
        
        foreach ($users as $user) {
            $user['municipality_id'] = 
            User::updateOrCreate([
                'email' => $user['email']],
                $user
            );
        }
    }
}
