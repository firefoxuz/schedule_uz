<?php

namespace App\Modules\Groups\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Groups\Actions\StoreGroupAction;
use App\Modules\Groups\Actions\UpdateGroupAction;
use App\Modules\Groups\Models\Group;
use App\Modules\Groups\Requests\GroupRequest;
use App\Modules\Groups\Resources\GroupResource;
use Illuminate\Http\Response;

class GroupController extends Controller
{
    public function index()
    {
        if (request()?->has('all')) {
            $groups = Group::all();
        } else {
            $groups = Group::paginate();
        }

        return GroupResource::collection($groups);
    }

    public function store(GroupRequest $request, StoreGroupAction $action)
    {
        return response()->json(
            new GroupResource($action->store($request->toDto())),
            Response::HTTP_CREATED
        );
    }

    public function show($id)
    {
        $group = Group::findOrFail($id);
        return new GroupResource($group);
    }

    public function update(GroupRequest $request, $id, UpdateGroupAction $action)
    {
        $group = Group::findOrFail($id);
        return response()->json(
            new GroupResource($action->update($request->toDto(), $group))
        );
    }

    public function destroy($id)
    {
        $group = Group::findOrFail($id);
        $group->delete();
        return response()->noContent();
    }
}
