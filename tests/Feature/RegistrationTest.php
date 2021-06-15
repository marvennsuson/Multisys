<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyEmail;
use Illuminate\Support\Str;

class RegistrationTest extends TestCase
{
    /**@test */
    public function a_user_can_register(){
        $input = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => Hash::make('password'),
            'email_verification_token' => Str::random(32)
        ];
        $user = User::create($input);
        $token =  $user->createToken('mytoken')->plainTextToken;
        Mail::to($user->email)->queue(new VerifyEmail($user));
 $this->postJson('api/register',$input, ['authorization' => "bearer $token"] )->assertStatus(200);
 $this->assertDatabaseHas($user->getTable(), array_merge($input));
     }
}
