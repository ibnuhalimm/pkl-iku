<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $idNumber = $this->faker->numberBetween(18, 20)
                    . $this->faker->randomElement([ '00', '01' ])
                    . $this->faker->numberBetween(10000, 9999);

        $availableStatus = array_keys(Student::getAllStatus());

        $status = $this->faker->randomElement($availableStatus);
        $certificate_date = null;

        $month_grad = null;
        $year_grad = null;
        if ($status == Student::STATUS_LULUS) {
            $month_grad = $this->faker->numberBetween(1, 12);
            $year_grad = $this->faker->numberBetween(2018, 2020);

            if ($month_grad < 10) {
                $month_grad = '0' . $month_grad;
            }

            $certificate_date = $year_grad . '-' . $month_grad . '-01';
        }


        return [
            'biodata_id' => $this->faker->numberBetween(14, 118),
            'study_program_id' => $this->faker->numberBetween(1, 11),
            'id_number' => $idNumber,
            'nisn' => '',
            'degree' => $this->faker->randomElement([ 'D3', 'S1' ]),
            'status' => $status,
            'month_entry' => $this->faker->numberBetween(1, 12),
            'year_entry' => $this->faker->numberBetween(2018, 2020),
            'month_grad' => $month_grad,
            'year_grad' => $year_grad,
            'origin_school' => $this->faker->company(),
            'origin_mayor' => null,
            'origin_year_grad' => null,
            'origin_score' => null,
            'certificate_date' => $certificate_date,
            'certificate_no' => null,
            'certificate_image' => null
        ];
    }
}
