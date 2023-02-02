<?php

namespace App\Modules\Subjects\Requests;

use App\Modules\Subjects\Dto\Subject;
use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function toDto(): Subject
    {
        $data = $this->validated();

        return new Subject($data['name']);
    }
}
