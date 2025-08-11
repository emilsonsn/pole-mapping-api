<?php

namespace Database\Seeders;

use App\Models\Maintenance;
use App\Models\User;
use Illuminate\Database\Seeder;

class MaintenanceSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first(); // usa o primeiro usuário como autor das manutenções

        $samples = [
            [
                'latitude' => '-7.116667',
                'longitude' => '-34.866667',
                'address' => 'Rua das Flores, 123',
                'neighborhood' => 'Centro',
                'city' => 'João Pessoa',
                'photo_path' => 'https://images.unsplash.com/photo-1579546929518-9e396f3cc809?auto=format&fit=crop&w=500&q=60',
            ],
            [
                'latitude' => '-7.119444',
                'longitude' => '-34.845833',
                'address' => 'Avenida Brasil, 500',
                'neighborhood' => 'Bancários',
                'city' => 'João Pessoa',
                'photo_path' => 'https://images.unsplash.com/photo-1579546929518-9e396f3cc809?auto=format&fit=crop&w=500&q=60',
            ],
            [
                'latitude' => '-7.128889',
                'longitude' => '-34.852222',
                'address' => 'Rua São Jorge, 12',
                'neighborhood' => 'Tambaú',
                'city' => 'João Pessoa',
                'photo_path' => 'https://images.unsplash.com/photo-1590608897129-79da98d159ab?auto=format&fit=crop&w=500&q=60',
            ],
        ];

        foreach ($samples as $sample) {
            Maintenance::updateOrCreate([
                'neighborhood' => $sample['neighborhood']
            ],array_merge(
                $sample,
                ['user_id' => $user?->id ?? 1]
            ));
        }
    }
}
