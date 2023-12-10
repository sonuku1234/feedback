<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Surveys;

class SurveysController extends Controller
{
    public function Surveys_Create(Request $request){
        // dd($request->all());
        $request->validate([
            'coordinator_id' =>'required|exists:users,id',
            'survey_name' =>'required|string',
            'questions' => 'required',
            'start_time'=>'required|date',
            'end_time'=>'required|date',
        ]);

        $survey = Surveys::create([
            'coordinator_id' =>$request->coordinator_id,
            'name' =>$request->survey_name,
            'questions' =>$request->questions,
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
}

// JSON OBJECT
// {
//     "coordinator_id": 1,
//     "survey_name": "name",
//     "questions": "test",
//     "start_time": "2023-01-01 00:00:00",
//     "end_time": "2024-01-10 00:00:00"
// }
