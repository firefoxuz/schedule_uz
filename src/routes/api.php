<?php

use App\Modules\Groups\Controllers\GroupController;
use App\Modules\Rooms\Controllers\RoomController;
use App\Modules\Schedules\Controllers\ScheduleController;
use App\Modules\Subjects\Controllers\SubjectController;
use App\Modules\Teachers\Controllers\TeacherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('rooms', RoomController::class);
    Route::apiResource('groups', GroupController::class);
    Route::apiResource('subjects', SubjectController::class);
    Route::apiResource('teachers', TeacherController::class);
    Route::apiResource('schedules', ScheduleController::class);
});

