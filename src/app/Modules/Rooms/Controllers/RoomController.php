<?php

namespace App\Modules\Rooms\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Groups\Models\Group;
use App\Modules\Rooms\Actions\StoreRoomAction;
use App\Modules\Rooms\Actions\UpdateRoomAction;
use App\Modules\Rooms\Models\Room;
use App\Modules\Rooms\Requests\RoomRequest;
use App\Modules\Rooms\Resources\RoomResource;
use Symfony\Component\HttpFoundation\Response;

class RoomController extends Controller
{
    public function index()
    {
        if (request()?->has('all')) {
            $rooms = Room::all();
        } else {
            $rooms = Room::paginate();
        }

        return RoomResource::collection($rooms);
    }

    public function store(RoomRequest $request, StoreRoomAction $action)
    {
        return response()->json(
            new RoomResource($action->store($request->toDto())),
            Response::HTTP_CREATED
        );
    }

    public function show($id)
    {
        $room = Room::findOrFail($id);
        return new RoomResource($room);
    }

    public function update(RoomRequest $request, $id, UpdateRoomAction $action)
    {
        $room = Room::findOrFail($id);
        return response()->json(
            new RoomResource($action->update($request->toDto(), $room))
        );
    }

    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();
        return response()->noContent();
    }
}
