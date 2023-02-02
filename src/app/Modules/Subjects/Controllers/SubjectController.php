<?php

namespace App\Modules\Subjects\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Rooms\Models\Room;
use App\Modules\Subjects\Actions\StoreSubjectAction;
use App\Modules\Subjects\Actions\UpdateSubjectAction;
use App\Modules\Subjects\Models\Subject;
use App\Modules\Subjects\Requests\SubjectRequest;
use App\Modules\Subjects\Resources\SubjectResource;
use Illuminate\Http\Response;

class SubjectController extends Controller
{
    public function index()
    {
        if (request()?->has('all')) {
            $subjects = Subject::all();
        } else {
            $subjects = Subject::paginate();
        }
        return SubjectResource::collection($subjects);
    }

    public function store(SubjectRequest $request, StoreSubjectAction $action)
    {
        return response()->json(
            new SubjectResource($action->store($request->toDto())),
            Response::HTTP_CREATED
        );
    }

    public function show($id)
    {
        $subject = Subject::findOrFail($id);
        return new SubjectResource($subject);
    }

    public function update(SubjectRequest $request, $id, UpdateSubjectAction $action)
    {
        $subject = Subject::findOrFail($id);
        return response()->json(
            new SubjectResource($action->update($request->toDto(), $subject))
        );
    }

    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();
        return response()->noContent();
    }
}
