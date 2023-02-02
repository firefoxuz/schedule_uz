<?php
/**
 * Created by Acer.
 * User: Acer
 * Date: 25/01/2023
 * Time: 20:40
 * File: Schedules.php
 */

namespace App\Modules\Schedules\Dto;

class Schedule
{
    public function __construct(
        public readonly int $group_id,
        public readonly int $teacher_id,
        public readonly int $room_id,
        public readonly int $subject_id,
        public readonly array $dows,
        public readonly string $from_date,
        public readonly string $to_date,
        public readonly string $from_time,
        public readonly string $to_time,
    )
    {
    }
}
