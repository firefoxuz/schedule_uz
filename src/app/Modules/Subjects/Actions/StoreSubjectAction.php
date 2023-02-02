<?php
/**
 * Created by Acer.
 * User: Acer
 * Date: 25/01/2023
 * Time: 15:19
 * File: StoreSubjectAction.php
 */

namespace App\Modules\Subjects\Actions;

use App\Modules\Subjects\Dto\Subject;
use App\Modules\Subjects\Models\Subject as SubjectModel;

class StoreSubjectAction
{
    public function store(Subject $subject): SubjectModel
    {
        return SubjectModel::create([
            'name' => $subject->name
        ]);
    }
}
