<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/register', 'RegistrationController@register')->middleware('guest');
Route::get('/verify/{token}', 'RegistrationController@VerifyEmail')->name('verifytoken')->middleware('guest');;
Route::post('/login', 'TokenController@store')->middleware(["throttle:10,2","guest"]);//"throttle:5,2"
// Route::delete('/logout', 'TokenController@destroy')->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->group(function () {
    Route::delete('/logout', 'TokenController@destroy');
    Route::get('/index', 'ProductController@index');
    Route::post('/store', 'ProductController@store');
    Route::get('/show/{product}', 'ProductController@show');
    Route::put('/update/{product}/form', 'ProductController@update');
    Route::delete('/delete/{product}', 'ProductController@destroy');
});
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
