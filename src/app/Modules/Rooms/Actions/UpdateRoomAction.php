<?php
/**
 * Created by Acer.
 * User: Acer
 * Date: 25/01/2023
 * Time: 11:30
 * File: UpdateRoomAction.php
 */

namespace App\Modules\Rooms\Actions;

use App\Modules\Rooms\Dto\Room;
use App\Modules\Rooms\Models\Room as RoomModel;

class UpdateRoomAction
{
    public function update(Room $room, RoomModel $roomModel): RoomModel
    {
        $roomModel->updateOrFail([
            'name' => $room->name
        ]);

        return $roomModel;
    }
}
