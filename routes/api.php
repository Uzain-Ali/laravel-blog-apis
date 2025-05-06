<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserAuthController;
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
Route::get("/text", function () {
    return ["name"=>"uzain", "email" => "uzain@gmail.com", "age" => 23];
});


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get("/student", [StudentController::class, "list"]);
    Route::post("/addStudent", [StudentController::class, "addStudent"]);
    Route::put("/updateStudent", [StudentController::class, "updateStudent"]);
    Route::delete("/deleteStudent/{id}", [StudentController::class, "deleteStudent"]);
    Route::resource('members', MemberController::class);
});

Route::get("/searchStudent/{name}", [StudentController::class, "searchStudent"]);

Route::post("/signup", [UserAuthController::class, "signup"]);
Route::post("/login", [UserAuthController::class, "login"])->name('login');