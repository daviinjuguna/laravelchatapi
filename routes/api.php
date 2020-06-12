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
Route::post('login','Api\LoginController@login');
Route::post('register','Api\RegisterController@register');
Route::post('refresh','Api\LoginController@refresh');
Route::post('recover','Api\ResetPasswordController@recover');
Route::post('change','Api\ResetPasswordController@change');

Route::middleware('auth:api')->group( function () {
    Route::post('logout', 'Api\LoginController@logout');
    Route::get('conversations','ConversationController@index');
    Route::post('conversations','ConversationController@store');
    Route::post('conversations/read','ConversationController@readConversation');
    Route::post('messages','MessageController@store');
});



