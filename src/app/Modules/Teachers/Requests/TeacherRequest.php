<?php

namespace App\Modules\Teachers\Requests;

use App\Modules\Teachers\Dto\Teacher;
use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:64',
            'last_name' => 'required|string|max:64',
            'birth_date' => 'required|string|date',
            'phone' => 'nullable|string'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function toDto(): Teacher
    {
        $data = $this->validated();
        return new Teacher(
            $data['first_name'],
            $data['last_name'],
            $data['birth_date'],
           $data['phone'] ?? '',
        );
    }
}
