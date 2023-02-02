<?php
/**
 * Created by Acer.
 * User: Acer
 * Date: 26/01/2023
 * Time: 14:50
 * File: ScheduleService.php
 */

namespace App\Modules\Schedules\Services;

use App\Modules\Schedules\Dto\Schedule;
use App\Modules\Schedules\Models\Schedule as ScheduleModel;
use Illuminate\Database\Eloquent\Builder;

class ScheduleService
{
    public function isRoomAvailable(Schedule $schedule): bool
    {
        return true;
    }
}
