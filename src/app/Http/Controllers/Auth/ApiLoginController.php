<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;

class ApiLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Api Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application from api requests. 
    |
    */
    public function login()
    {
        $request = request();

        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['These credentials do not match our records.']
            ], 401);
        }

        $token = $user->createToken('document-app-token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);

    }
}
