<?php
/**
 * Created by Acer.
 * User: Acer
 * Date: 25/01/2023
 * Time: 14:26
 * File: UpdateGroupAction.php
 */

namespace App\Modules\Groups\Actions;

use App\Modules\Groups\Dto\Group;
use App\Modules\Groups\Models\Group as GroupModel;

class UpdateGroupAction
{
    public function update(Group $group, GroupModel $groupModel): GroupModel
    {
        $groupModel->updateOrFail([
            'name' => $group->name
        ]);

        return $groupModel;
    }
}
