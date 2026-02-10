<?php

namespace Database\Factories;

use App\Enums\CompanyServiceModeEnum;
use App\Models\Company;
use App\Models\Municipality;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'trade_name' => $this->faker->companySuffix,
            'cnpj' => $this->faker->numerify('##.###.###/####-##'),
            'state_registration' => $this->faker->numerify('#########'),
            'municipal_registration' => $this->faker->numerify('######'),
            'email' => $this->faker->companyEmail,
            'phone' => $this->faker->phoneNumber,
            'website' => $this->faker->url,
            'address' => $this->faker->streetName,
            'address_number' => $this->faker->buildingNumber,
            'address_neighborhood' => $this->faker->citySuffix,
            'address_city' => $this->faker->city,
            'address_state' => $this->faker->stateAbbr,
            'address_zipcode' => $this->faker->postcode,
            'municipality_id' => Municipality::factory(),
            'service_mode' =>   $this->faker->randomElement(CompanyServiceModeEnum::cases()),
        ];
    }
}
