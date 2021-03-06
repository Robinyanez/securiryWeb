<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Auth;
use Carbon\Carbon;

class AuthController extends Controller
{

    public function login(Request $request){

        if (Auth::attempt(['cedula' => request('cedula'), 'password' => request('password')])) {
            /* $user = Auth::user(); */
            $user_id = Auth::user()->id;
            $user = User::with('client','client.zone')->where('id',$user_id)->firstOrFail();
            $role = $user->cargo_id;
            $zone = $user->client->zone_id;
            $token = $user->createToken('Personal Access Token')->accessToken;
            return response()->json([
                'status' => true,
                'zone' => $zone,
                'role' => $role,
                'token' => $token
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }
    }


    public function logout(Request $request){

        $request->user()->token()->revoke();

        return response()->json([
            'status' => true,
            'message' => 'Successfully logged out'
        ]);
    }

    /* tests */

    /* public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');

        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
        ]);
    } */

}
