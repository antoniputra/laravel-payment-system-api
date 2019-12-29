<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\ApiController;

class AuthController extends ApiController
{
    public function coba()
    {
        // return response()->setStatusCode(200)->json(Auth::user());
        return response()->json([
            'message' => 'Login Failed'
        ], 401);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json(Auth::user(), 200);
        }

        return response()->json([
            'message' => 'Login Failed'
        ], 401);
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirm',
        ]);

        $user = User::create($request->all());
        
        // Auth::login($user, $user);

        return response()->json($user, 200);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json(['message' => 'Successfully logout.']);
    }
}
