<?php
/**
 * Created by Acer.
 * User: Acer
 * Date: 25/01/2023
 * Time: 11:12
 * File: StoreRoomAction.php
 */

namespace App\Modules\Rooms\Actions;

use App\Modules\Rooms\Dto\Room;
use App\Modules\Rooms\Models\Room as RoomModel;

class StoreRoomAction
{
    public function store(Room $room): RoomModel
    {
        return RoomModel::create([
            'name' => $room->name
        ]);
    }
}
