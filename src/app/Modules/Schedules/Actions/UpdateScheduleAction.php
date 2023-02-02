<?php
/**
 * Created by Acer.
 * User: Acer
 * Date: 25/01/2023
 * Time: 22:18
 * File: UpdateScheduleAction.php
 */

namespace App\Modules\Schedules\Actions;

use App\Modules\Schedules\Dto\Schedule;
use App\Modules\Schedules\Models\Schedule as ScheduleModel;

class UpdateScheduleAction
{
    public function update(Schedule $schedule, ScheduleModel $scheduleModel): ScheduleModel
    {
        $scheduleModel->update([
            'room_id' => $schedule->room_id,
            'subject_id' => $schedule->subject_id,
            'teacher_id' => $schedule->teacher_id,
            'group_id' => $schedule->group_id,
            'from_date' => $schedule->from_date,
            'to_date' => $schedule->to_date,
            'from_time' => $schedule->from_time,
            'to_time' => $schedule->to_time
        ]);
        $scheduleModel->dows()->sync($schedule->dows);
        return $scheduleModel;
    }
}
