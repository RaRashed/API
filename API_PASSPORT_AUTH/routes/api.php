<?php

use App\Http\Controllers\Api\AuthorController;
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
Route::get("create",[AuthorController::class,"index"]);
Route::post("register",[AuthorController::class,"register"]);
Route::post("register",[AuthorController::class,"register"]);
Route::post("login",[AuthorController::class,"login"]);
Route::group(["middleware"=>["auth:api"]],function(){
    Route::get("profile",[AuthorController::class,"profile"]);
    Route::get("logout",[AuthorController::class,"logout"]);

    //BOOKS API ROUTE
   // Route::post("create-book",[AuthorController::class,"create-book"]);
    Route::get("list-books",[AuthorController::class,"listBooks"]);
    Route::get("single-book/{id}",[AuthorController::class,"singleBook"]);
    Route::post("update-book/{id}",[AuthorController::class,"updateBook"]);
    Route::get("delete-book/{id}",[AuthorController::class,"deleteBook"]);


});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
