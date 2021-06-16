<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class TokenController extends Controller
{
    protected $maxAttempts = 3; // Default is 5
    protected $decayMinutes = 2; // Default is 1
    
    public function store(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = User::firstWhere('email', $request->email);

            $data = $user->createToken(
                "{$user->name}'s Device"
            )->plainTextToken;

            $response = ['status' => true, 'msg' => 'User Successfully Login' , 'access_token' => $data ];
            return response()->json($response, 201);
        } else {
            $response = ['status' => false, 'msg' => 'Invalid Credentials'];
            return response()->json($response, 401);
        }
    }

    public function destroy(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        $response = ['status' => true, 'msg' => 'Logout Success'];
        return response()->json($response, 200);
    } //
}
