<?php
/**
 * Created by Acer.
 * User: Acer
 * Date: 25/01/2023
 * Time: 20:52
 * File: StoreScheduleAction.php
 */

namespace App\Modules\Schedules\Actions;

use App\Modules\Schedules\Dto\Schedule;
use App\Modules\Schedules\Models\Schedule as ScheduleModel;
use App\Modules\Schedules\Services\ScheduleService;

class StoreScheduleAction
{
    private $service;

    public function __construct(ScheduleService $service)
    {
        $this->service = $service;
    }

    public function store(Schedule $schedule): ScheduleModel
    {
        if (!$this->service->isRoomAvailable($schedule)) {
            throw new \Exception('room not available');
        }

        $model = new ScheduleModel();
        $model->setRawAttributes(
            [
                'room_id' => $schedule->room_id,
                'subject_id' => $schedule->subject_id,
                'teacher_id' => $schedule->teacher_id,
                'group_id' => $schedule->group_id,
                'from_date' => $schedule->from_date,
                'to_date' => $schedule->to_date,
                'from_time' => $schedule->from_time,
                'to_time' => $schedule->to_time
            ]);
        $model->save();
        $model->dows()->sync($schedule->dows);
        return $model;
    }
}
