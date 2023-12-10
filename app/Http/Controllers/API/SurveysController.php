<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Surveys;
use App\Models\Users;

class SurveysController extends Controller
{

    public function Surveys_Create(Request $request){
    //   dd($request->all());
        $request->validate([
            'coordinator_id' =>'required|exists:users,id',
            'survey_name' =>'required|string',
            'questions' => 'required',
            'min_age' => 'required',
            'max_age' => 'required',
            'gender' => 'required',
            'start_time'=>'required|date',
            'end_time'=>'required|date',
        ]);
        $coordinator =Users::findOrFail($request->coordinator_id);
            // dd($coordinator);
        if ($coordinator->user_type !== 'coordinator') {
            return response()->json(['error_response' => 'Only coordinators can create surveys'], 403);
        }
        $survey = Surveys::create([
            'coordinator_id' =>$request->coordinator_id,
            'name' =>$request->survey_name,
            'questions' =>$request->questions,
            'min_age' =>$request->min_age,
            'max_age' =>$request->max_age,
            'gender' =>$request->gender,
            'start_time' =>$request->start_time,
            'end_time' =>$request->end_time,

            // dd($request->end_time),

        ]);

        return response()->json(['Response' => "New Survey Create Successfully"], 201);
    }


    public function Surveys_Edit(Request $request, $id)
    {
    //   dd("ds");
       $FetchSurvey = Surveys::findOrFail($id);
    //    dd($FetchSurvey);
    $FetchSurvey->update([
        'name' => $request->name,
        'questions' => $request->questions,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
    ]);

    return response()->json(['Response' => "$FetchSurvey->name Update Successfully"], 200);
    }

    public function getEligibleSurveys(Request $request)
    {
        $respondent = Users::findOrFail($request->respondent_id);

        if ($respondent->user_type == 'respondent') {
            $eligibleSurveys = Surveys::where('min_age', '<=', $respondent->age)
                ->where('max_age', '>=', $respondent->age)
                ->where('gender', $respondent->gender)
               
                ->get();

            return response()->json(['eligible_surveys' => $eligibleSurveys], 200);
        } else {
            return response()->json(['error_response' => 'Only respondents can see surveys'], 403);
        }
    }


    public function StoreResponse(Request $request){
        $response = Response::create([
            'survey_id' => $surveyId,
            'user_id' => $request->user_id,
            'responses' => $request->responses,
        ]);
    }
}

// JSON OBJECT
// {
//     "coordinator_id": 1,
//     "survey_name": "name",
//     "questions": "test",
//     "start_time": "2023-01-01 00:00:00",
//     "end_time": "2024-01-10 00:00:00"
// }
