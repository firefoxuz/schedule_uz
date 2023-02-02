<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Modules\Groups\Models\Group;
use App\Modules\Rooms\Models\Room;
use App\Modules\Schedules\Models\Schedule;
use App\Modules\Subjects\Models\Subject;
use App\Modules\Teachers\Models\Teacher;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DowSeeder::class);

        /**
         * Factories
         */
        Group::factory(100)->create();
        Room::factory(100)->create();
        Subject::factory(100)->create();
        Teacher::factory(100)->create();
        Schedule::factory(100)
            ->create()->each(function (Schedule $schedule) {
                $schedule->dows()->sync([random_int(1, 3), random_int(4, 7)]);
            });


    }
}
