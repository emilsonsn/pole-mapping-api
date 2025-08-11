<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Type;
use App\Models\Paving;
use App\Models\Position;
use App\Models\NetworkType;
use App\Models\ConnectionType;
use App\Models\Transformer;
use App\Models\Access;

class PoleAuxiliarySeeder extends Seeder
{
    public function run(): void
    {
        // Types
        Type::updateOrCreate(['value' => 'Tipo 1'], ['name' => 'Tipo 1']);
        Type::updateOrCreate(['value' => 'Tipo 2'], ['name' => 'Tipo 2']);

        // Pavings
        Paving::updateOrCreate(['value' => 'Calçamento 1'], ['name' => 'Calçamento 1']);
        Paving::updateOrCreate(['value' => 'Calçamento 2'], ['name' => 'Calçamento 2']);

        // Positions
        Position::updateOrCreate(['value' => 'Posição 1'], ['name' => 'Posição 1']);
        Position::updateOrCreate(['value' => 'Posição 2'], ['name' => 'Posição 2']);

        // NetworkTypes
        NetworkType::updateOrCreate(['value' => 'Rede 1'], ['name' => 'Rede 1']);
        NetworkType::updateOrCreate(['value' => 'Rede 2'], ['name' => 'Rede 2']);

        // ConnectionTypes
        ConnectionType::updateOrCreate(['value' => 'Ligação 1'], ['name' => 'Ligação 1']);
        ConnectionType::updateOrCreate(['value' => 'Ligação 2'], ['name' => 'Ligação 2']);

        // Transformers
        Transformer::updateOrCreate(['value' => 'Transformador 1'], ['name' => 'Transformador 1']);
        Transformer::updateOrCreate(['value' => 'Transformador 2'], ['name' => 'Transformador 2']);

        // Accesses
        Access::updateOrCreate(['value' => 'Acesso 1'], ['name' => 'Acesso 1']);
        Access::updateOrCreate(['value' => 'Acesso 2'], ['name' => 'Acesso 2']);
    }
}
