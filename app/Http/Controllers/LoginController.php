<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {

        $this->validateLogin($request);

        if (Auth::attempt($request->only('email', 'password'))) {
            $token = $request->user()->createToken($request->email)->plainTextToken;
            return response()->json([
                'token' => $token,
                'user' => $request->user(),
                'message' => 'Success'
            ]);
        }

        return response()->json([
            'message' => 'Unauthenticated'
        ], 401);
    }

    public function validateLogin(Request $request)
    {

        return $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
    }

    public function saveUser(UsersRequest $request)
    {

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password'])
        ]);

        return response()->json([
            'user' => $user,
            'message' => 'Success'
        ]); 
    }

    public function loginOrSingInGoogle(Request $request){

        $user = User::where(['email' => $request['email'], 'password' => $request['password']])->first();

        if (isset($user)) {
            $token = $user->createToken($user->email)->plainTextToken;
            return response()->json([
                'user' => $user,
                'token' => $token,
                'message' => 'Success'
            ]); 
        }else{

            $user = User::create([
                'email' => $request['email'],
                'name' => $request['name'],
                'photo' => $request['photo'],
                'password' => $request['password']]
            );
            $token = $user->createToken($user->email)->plainTextToken;
            return response()->json([
                'user' => $user,
                'token' => $token,
                'message' => 'New User'
            ]); 
        }
        
    }
}
