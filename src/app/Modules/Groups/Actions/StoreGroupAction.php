<?php
/**
 * Created by Acer.
 * User: Acer
 * Date: 25/01/2023
 * Time: 14:20
 * File: StoreGroupAction.php
 */

namespace App\Modules\Groups\Actions;

use App\Modules\Groups\Dto\Group;
use App\Modules\Groups\Models\Group as GroupModel;

class StoreGroupAction
{
    public function store(Group $group): GroupModel
    {
        return GroupModel::create([
            'name' => $group->name
        ]);
    }
}
