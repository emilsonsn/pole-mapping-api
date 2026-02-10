<?php

namespace Database\Factories;

use App\Models\Municipality;
use Illuminate\Database\Eloquent\Factories\Factory;

class MunicipalityFactory extends Factory
{
    protected $model = Municipality::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->city,
            'cnpj' => $this->faker->numerify('##.###.###/####-##'),
            'state' => $this->faker->stateAbbr,
            'ibge_code' => $this->faker->numerify('######'),
            'email' => $this->faker->city . '@prefeitura.gov.br',
            'phone' => $this->faker->phoneNumber,
            'website' => 'https://www.' . $this->faker->slug . '.gov.br',
            'address' => $this->faker->streetName,
            'address_number' => $this->faker->buildingNumber,
            'address_neighborhood' => $this->faker->citySuffix,
            'address_zipcode' => $this->faker->postcode,
        ];
    }
}
