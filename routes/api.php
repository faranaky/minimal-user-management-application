<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login', 'ApiController@login');
Route::get('/guest', 'ApiController@guest')->name('login');

Route::group(['middleware' => ['auth:api']], function () {

    Route::get('groups', 'GroupController@index');
    Route::get('groups/{id}', 'GroupController@show');
    Route::post('groups', 'GroupController@store');
    Route::put('groups/{id}', 'GroupController@update');
    Route::delete('groups/{id}', 'GroupController@delete');

    Route::get('users', 'UserController@index');
    Route::get('users/{id}', 'UserController@show');
    Route::post('users', 'UserController@store');
    Route::put('users/{id}', 'UserController@update');
    Route::delete('users/{id}', 'UserController@delete');
});
