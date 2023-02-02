<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DowSeeder extends Seeder
{
    public const DAYS_OF_WEEK = [
        1 => 'monday',
        2 => 'tuesday',
        3 => 'wednesday',
        4 => 'thursday',
        5 => 'friday',
        6 => 'saturday',
        7 => 'sunday',
    ];

    public function run(): void
    {
        foreach (self::DAYS_OF_WEEK as $num => $name) {
            DB::table('dows')->insert([
                'name' => $name,
                'iso_num' => $num,
            ]);
        }
    }
}
