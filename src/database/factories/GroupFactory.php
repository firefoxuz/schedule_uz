<?php

namespace Database\Factories;

use App\Modules\Groups\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    protected $model = Group::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->numerify('###-group'),
        ];
    }
}
