<?php

use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\StudentController;
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

//Student Api Route
Route::post("student/register",[StudentController::class,"register"]);
Route::post("student/login",[StudentController::class,"login"]);
Route::group(["middleware" => ["auth:sanctum"]], function(){

    Route::get("student/profile",[StudentController::class,"profile"]);
    Route::get("student/logout",[StudentController::class,"logout"]);

    //Project Api Route
    Route::post("project/create",[ProjectController::class,"createProject"]);
    Route::get("project/list",[ProjectController::class,"listProject"]);
    Route::get("project/single/{id}",[ProjectController::class,"singleProject"]);
    Route::delete("project/delete/{id}",[ProjectController::class,"delete/{id}Project"]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});





