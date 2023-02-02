<?php

namespace App\Modules\Schedules\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @see \App\Modules\Schedules\Models\Schedule */
class ScheduleResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'group' => $this->group->only(['id', 'name']),
            'teacher' => $this->teacher->only(['id', 'first_name', 'last_name', 'phone']),
            'room' => $this->room->only(['id','name']),
            'subject' => $this->subject->only(['id','name']),
            'dows' => $this->dows,
            'from_date' => $this->from_date,
            'to_date' => $this->to_date,
            'from_time' => $this->from_time,
            'to_time' => $this->to_time,
        ];
    }
}
