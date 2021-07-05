<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $companyName = $this->faker->company();
        $brandName = strtok(strtok($companyName, ' '), ',');

        return [
            'company_category_id' => $this->faker->numberBetween(1, 7),
            'name' => $companyName,
            'brand' => $brandName,
            'address' => $this->faker->address(),
            'province_id' => $this->faker->numberBetween(31, 35),
            'city_id' => $this->faker->numberBetween(3101, 3530)
        ];
    }
}
