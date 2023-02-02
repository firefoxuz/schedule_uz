<?php

namespace Database\Factories;

use App\Modules\Subjects\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubjectFactory extends Factory
{
    protected $model = Subject::class;

    public function definition(): array
    {
        return [
            'name' => ucfirst($this->faker->word()),
        ];
    }
}
