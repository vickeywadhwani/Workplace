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
Route::get('/workplaces', 'WorkplaceController@index')->name('show.workplaces');
Route::post('/workplace','WorkplaceController@store')->name('store.workplace');
Route::get('/workplace/{id}', 'WorkplaceController@show')->name('show.workplace');
Route::put('/workplace/{id}', 'WorkplaceController@update')->name('update.workplace');
Route::delete('/workplace/{id}', 'WorkplaceController@destroy')->name('destroy.workplace');
