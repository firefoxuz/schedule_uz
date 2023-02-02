<?php
/**
 * Created by Acer.
 * User: Acer
 * Date: 26/01/2023
 * Time: 10:13
 * File: ScheduleFilter.php
 */

namespace App\Modules\Schedules\Filters;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class ScheduleFilter extends QueryFilter
{
    public function date($value)
    {
        return $this->builder
            ->whereDate('from_date', '<=', $value)
            ->whereDate('to_date', '>=', $value)
            ->whereHas('dows', function (Builder $builder) use ($value) {
                $builder->where('iso_num', Carbon::createFromFormat('Y-m-d', $value)->dayOfWeek);
            });
    }

    public function time($value)
    {
        return $this->builder
            ->whereTime('from_time', '<=', $value)
            ->whereTime('to_time', '>=', $value);
    }

    public function group($value)
    {
        return $this->builder->whereHas('group', function (Builder $builder) use ($value) {
            $builder->where('name', 'like', "%$value%");
        });
    }

    public function room($value)
    {
        return $this->builder->whereHas('room', function (Builder $builder) use ($value) {
            $builder->where('name', 'like', "%$value%");
        });
    }

    public function teacher($value)
    {
        return $this->builder->whereHas('teacher', function (Builder $builder) use ($value) {
            $builder->where('first_name', 'like', "%$value%")
                ->orWhere('last_name', 'like', "%$value%");
        });
    }
}
