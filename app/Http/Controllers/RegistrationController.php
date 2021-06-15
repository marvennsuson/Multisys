<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use  Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{
    public function register(Request $request)
    { //RegisterRequest

        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'name' => 'required|string',
            'password' => 'required|string',
        ]);
   
        if ($validator->fails()) {
            $response = ['status' => false, 'msg' => $validator->errors()];
            return response()->json($response, 400);
        }

        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verification_token' => Str::random(32)
        ];
        $user = User::create($input);
        $success['token'] =  $user->createToken('mytoken')->plainTextToken;
        $success['name'] =  $user->name;
        Mail::to($user->email)->queue(new VerifyEmail($user));

        $response = ['status' => true, 'msg' => 'User Successfully regustered'];
        return response()->json($response, 201);
    }

    public function VerifyEmail($token = null)
    {
        if ($token == null) {
            $response = ['status' => false, 'msg' => 'Invalid Login attempt Token Null'];
            return response()->json($response, 404);
        }

        $user = User::where('email_verification_token', $token)->first();

        if ($user == null) {
            $response = ['status' => false, 'msg' => 'Invalid Login attempt Cannot Find user'];
            return response()->json($response, 404);
        }

        $user->update([
        
        'email_verified' => 1,
        'email_verified_at' => Carbon::now(),
        'email_verification_token' => ''

       ]);
       
 
        $response = ['status' => true, 'msg' => 'Your account is activated, you can log in now'];
        return response()->json($response, 200);
    }
}
