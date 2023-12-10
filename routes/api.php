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


// "respondent_id":2

Route::post('users-create-api', [UsersController::class, 'UsersStore']);
// {
//     "name":"coordinator",
//     "email":"coordinator@gmail.com",
//     "password":"admin#123",
//     "gender":"male",
//     "age":20,
//     "user_type":"coordinator"
// }

Route::post('surveys-create-api', [SurveysController::class, 'Surveys_Create']);
// {
//     "coordinator_id":1,
//     "survey_name":"ProductFeedbackSurvey",
//     "questions":"How satisfied are you with our products?",
//     "gender":"male",
//     "min_age":13,
//     "max_age":50,
//     "start_time":"2023-12-09 12:00:00",
//     "end_time":"2024-12-09 12:00:00"


// }

Route::put('surveys-edit/{id}', [SurveysController::class, 'Surveys_Edit']);

Route::get('get-eligible-surveys-api', [SurveysController::class, 'getEligibleSurveys']);


Route::post('surveys-responses-store-api', [SurveysController::class, 'StoreResponse']);
// {
//     "respondent_id":2,
//     "surveyId":2,
//     "answers":"Good"

// }




Route::post('get-completed-surveys-api', [SurveysController::class, 'getSurveysWithResponsesByCoordinator']);

// send coordinatorId in body json
// {
//     "coordinatorId":1
// }
