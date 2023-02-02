<?php

namespace Database\Factories;

use App\Modules\Teachers\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TeacherFactory extends Factory
{
    protected $model = Teacher::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'birth_date' =>$this->faker->date(),
            'phone' => $this->faker->e164PhoneNumber(),
        ];
    }
}
