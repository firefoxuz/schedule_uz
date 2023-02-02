<?php

namespace App\Modules\Schedules\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterScheduleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            /* Filter params */
            'date' => 'nullable|date',
            'time' => 'nullable|date_format:H:i:s',
            'group' => 'nullable|string',
            'room' => 'nullable|string',
            'teacher' => 'nullable|string',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
