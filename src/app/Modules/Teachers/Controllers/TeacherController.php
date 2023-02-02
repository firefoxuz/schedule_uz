<?php

namespace App\Modules\Teachers\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Subjects\Models\Subject;
use App\Modules\Teachers\Actions\StoreTeacherAction;
use App\Modules\Teachers\Actions\UpdateTeacherAction;
use App\Modules\Teachers\Models\Teacher;
use App\Modules\Teachers\Requests\TeacherRequest;
use App\Modules\Teachers\Resources\TeacherResource;
use Illuminate\Http\Response;

class TeacherController extends Controller
{

    public function index()
    {
        if (request()?->has('all')) {
            $teachers = Teacher::all();
        } else {
            $teachers = Teacher::paginate();
        }
        return TeacherResource::collection($teachers);
    }

    public function store(TeacherRequest $request, StoreTeacherAction $action)
    {
        return response()->json(
            new TeacherResource($action->store($request->toDto())),
            Response::HTTP_CREATED
        );
    }

    public function show($id)
    {
        $teacher = Teacher::findOrFail($id);
        return new TeacherResource($teacher);
    }

    public function update(TeacherRequest $request, $id, UpdateTeacherAction $action)
    {
        $teacher = Teacher::findOrFail($id);
        return response()->json(
            new TeacherResource($action->update($request->toDto(), $teacher))
        );
    }

    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();
        return response()->noContent();
    }
}
