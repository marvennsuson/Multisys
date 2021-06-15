<?php

namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use App\User;
use Tests\TestCase;

class Register extends TestCase
{
    public function user_register(){
       $response =  $this->post('/register',[
            "email" => 'marvenn@gmail.com',
            "name" => 'Marvenn',
            "password" => Hash::make('password'),
        ]);
        $response->assertOk();
        $this->assertCount(1, User::all());

    }
}
