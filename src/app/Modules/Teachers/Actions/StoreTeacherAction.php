<?php
/**
 * Created by Acer.
 * User: Acer
 * Date: 25/01/2023
 * Time: 17:36
 * File: StoreTeacherAction.php
 */

namespace App\Modules\Teachers\Actions;

use App\Modules\Teachers\Dto\Teacher;
use App\Modules\Teachers\Models\Teacher as TeacherModel;

class StoreTeacherAction
{
    public function store(Teacher $dto): TeacherModel
    {
        return TeacherModel::create([
            'first_name' => $dto->first_name,
            'last_name' => $dto->last_name,
            'birth_date' => $dto->birth_date,
            'phone' => $dto->phone
        ]);
    }
}
