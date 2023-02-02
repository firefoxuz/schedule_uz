<?php

namespace Database\Factories;

use App\Modules\Groups\Models\Group;
use App\Modules\Rooms\Models\Room;
use App\Modules\Schedules\Models\Schedule;
use App\Modules\Subjects\Models\Subject;
use App\Modules\Teachers\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScheduleFactory extends Factory
{
    protected $model = Schedule::class;

    public function definition(): array
    {
        return [
            'group_id' => $this->faker->numberBetween(1, $this->getGroupCount()),
            'teacher_id' => $this->faker->numberBetween(1, $this->getTeacherCount()),
            'room_id' => $this->faker->numberBetween(1, $this->getRoomCount()),
            'subject_id' => $this->faker->numberBetween(1, $this->getSubjectCount()),
            'from_date' => $this->faker->date(),
            'to_date' => $this->faker->date(),
            'from_time' => $this->faker->time(),
            'to_time' => $this->faker->time(),
        ];
    }

    private function getGroupCount(): int
    {
        return Group::query()->count('id');
    }

    private function getTeacherCount(): int
    {
        return Teacher::query()->count('id');
    }

    private function getRoomCount(): int
    {
        return Room::query()->count('id');
    }

    private function getSubjectCount(): int
    {
        return Subject::query()->count('id');
    }
}
