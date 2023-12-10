<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;

class UsersController extends Controller
{
    public function UsersStore(Request $request){
        $request->validate([
            'name'=>'required',
            'email' => 'required|email|unique:users',
            'password'=>'required|min:4',
            'gender'=>'required|in:male,female,other',
            'age'=>'required|integer',
            'user_type' => 'required|in:coordinator,respondent',
        ]);

        $user = Users::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password' => bcrypt($request->password),
            'gender'=>$request->gender,
            'age'=>$request->age,
            'user_type'=>$request->user_type,
        ]);

        return response()->json(['Response' => "New User Create Successfully"], 201);
    }

    
}
