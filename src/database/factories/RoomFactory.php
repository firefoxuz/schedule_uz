<?php

namespace Database\Factories;

use App\Modules\Rooms\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    protected $model = Room::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->numerify('###-room'),
        ];
    }
}
