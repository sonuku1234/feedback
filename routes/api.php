<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UsersController;
use App\Http\Controllers\API\SurveysController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('users-create-api', [UsersController::class, 'UsersStore']);

Route::post('surveys-create-api', [SurveysController::class, 'Surveys_Create']);

Route::put('surveys-edit/{id}', [SurveysController::class, 'Surveys_Edit']);


