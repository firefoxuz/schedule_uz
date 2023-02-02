<?php

namespace App\Modules\Rooms\Requests;

use App\Modules\Rooms\Dto\Room;
use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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

    public function toDto(): Room
    {
        $data = $this->validated();

        return new Room($data['name']);
    }
}
