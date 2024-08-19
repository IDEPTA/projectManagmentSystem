<?php

use App\Http\Controllers\Api\AddAvatarController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post("/addAvatar/{id}", AddAvatarController::class);

Route::get("/getMaxUserTask", [UserController::class, "getMaxUserTask"]);
Route::get("/getTasksForConcreteUser/{id}", [UserController::class, "getTasksForConcreteUser"]);
Route::get("/getCountTaskForUser", [UserController::class, "getCountTaskForUser"]);

Route::get("/getTaskForProject", [ProjectController::class, "getCountTaskForProject"]);
Route::get("/hightPriorityTasks", [ProjectController::class, "hightPriorityTasks"]);
Route::get("/getCompletedTaskForProject", [ProjectController::class, "getCompletedTaskForProject"]);
Route::get("/getTeamForProject/{id}", [ProjectController::class, "getTeamForProject"]);
Route::get("/getTeamForTask/{id}", [ProjectController::class, "getTeamForTask"]);
