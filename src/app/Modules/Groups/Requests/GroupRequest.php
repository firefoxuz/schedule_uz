<?php

namespace App\Modules\Groups\Requests;

use App\Modules\Groups\Dto\Group;
use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:64'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function toDto(): Group
    {
        $data = $this->validated();

        return new Group($data['name']);
    }
}
