<?php

namespace App\Modules\Schedules\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Schedules\Actions\StoreScheduleAction;
use App\Modules\Schedules\Actions\UpdateScheduleAction;
use App\Modules\Schedules\Filters\ScheduleFilter;
use App\Modules\Schedules\Models\Schedule;
use App\Modules\Schedules\Requests\FilterScheduleRequest;
use App\Modules\Schedules\Requests\ScheduleRequest;
use App\Modules\Schedules\Resources\ScheduleResource;
use Illuminate\Http\Response;

class ScheduleController extends Controller
{
    public function index(FilterScheduleRequest $request)
    {
        $schedule = Schedule::query();
        $schedules = (new ScheduleFilter($schedule, $request))->apply()->paginate();
        return ScheduleResource::collection($schedules);
    }

    public function store(ScheduleRequest $request, StoreScheduleAction $action)
    {
        return response()->json(
            new ScheduleResource($action->store($request->toDto())),
            Response::HTTP_CREATED
        );
    }

    public function show($id)
    {
        $schedule = Schedule::findOrFail($id);
        return new ScheduleResource($schedule);
    }

    public function update(ScheduleRequest $request, $id, UpdateScheduleAction $action)
    {
        $schedule = Schedule::findOrFail($id);
        return response()->json(
            new ScheduleResource($action->update($request->toDto(), $schedule))
        );
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();
        return response()->noContent();
    }
}
