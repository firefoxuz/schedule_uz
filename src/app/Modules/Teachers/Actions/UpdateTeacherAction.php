<?php
/**
 * Created by Acer.
 * User: Acer
 * Date: 25/01/2023
 * Time: 17:42
 * File: UpdateTeacherAction.php
 */

namespace App\Modules\Teachers\Actions;

use App\Modules\Teachers\Dto\Teacher;
use App\Modules\Teachers\Models\Teacher as TeacherModel;

class UpdateTeacherAction
{
    public function update(Teacher $teacher, TeacherModel $teacherModel): TeacherModel
    {
        $teacherModel->updateOrFail([
            'first_name' => $teacher->first_name,
            'last_name' => $teacher->last_name,
            'birth_date' => $teacher->birth_date,
            'phone' => $teacher->phone
        ]);

        return $teacherModel;
    }
}
