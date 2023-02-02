<?php

namespace App\Modules\Schedules\Requests;

use App\Modules\Schedules\Dto\Schedule;
use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'group_id' => 'required|int|exists:groups,id',
            'teacher_id' => 'required|int|exists:teachers,id',
            'room_id' => 'required|int|exists:rooms,id',
            'subject_id' => 'required|int|exists:subjects,id',
            'dows' => 'required|array',
            'dows.*' => 'required|int|exists:dows,id',
            'from_date' => 'required|date',
            'to_date' => 'required|date',
            'from_time' => 'required|date_format:H:i:s',
            'to_time' => 'required|date_format:H:i:s',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function toDto()
    {
        $data = $this->validated();
        return new Schedule(
            $data['group_id'],
            $data['teacher_id'],
            $data['room_id'],
            $data['subject_id'],
            $data['dows'],
            $data['from_date'],
            $data['to_date'],
            $data['from_time'],
            $data['to_time'],
        );
    }
}
