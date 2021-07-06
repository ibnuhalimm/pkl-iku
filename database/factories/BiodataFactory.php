<?php

namespace Database\Factories;

use App\Models\Biodata;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BiodataFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Biodata::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $photoFile = $this->faker->image('storage/app/public/biodata', 400, 400, 'persons');

        $countryCodes = [];
        $countries = Country::all();
        $countries->map(function($country) use ($countryCodes) {
            array_push($countryCodes, $country->code);
        });

        return [
            'id_card_number' => $this->faker->nik(),
            'name' => $this->faker->firstName(),
            'photo' => Str::of($photoFile)->replace('storage/app/public/', ''),
            'birth_place' => $this->faker->city(),
            'birth_date' => $this->faker->dateTimeBetween('-30 years', '-18 years'),
            'gender' => $this->faker->randomElement(['L', 'P']),
            'blood_type' => $this->faker->randomElement(['', 'A', 'AB', 'B', 'O']),
            'religion_id' => $this->faker->randomElement([1, 7]),
            'marital_status' => $this->faker->randomElement([0, 1]),
            'address' => $this->faker->address(),
            'province_id' => $this->faker->numberBetween(31, 35),
            'city_id' => $this->faker->numberBetween(3101, 3530),
            'district_id' => '',
            'village_id' => '',
            'postcode' => $this->faker->postcode(),
            'citizen' => $this->faker->randomElement(['WNI', 'WNA']),
            'country_code' => $this->faker->randomElement($countryCodes),
            'phone' => $this->faker->e164PhoneNumber(),
            'email' => $this->faker->safeEmail(),
        ];
    }
}
