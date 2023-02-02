<?php
/**
 * Created by Acer.
 * User: Acer
 * Date: 25/01/2023
 * Time: 15:24
 * File: UpdateSubjectAction.php
 */

namespace App\Modules\Subjects\Actions;

use App\Modules\Subjects\Dto\Subject;
use App\Modules\Subjects\Models\Subject as SubjectModel;

class UpdateSubjectAction
{
    public function update(Subject $subject, SubjectModel $subjectModel): SubjectModel
    {
        $subjectModel->updateOrFail([
            'name' => $subject->name
        ]);

        return $subjectModel;
    }
}
