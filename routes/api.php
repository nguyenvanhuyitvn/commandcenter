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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('login', 'api\UserController@login')->name('login');
Route::post('register', 'api\UserController@register')->name('register');
Route::group(['middleware' => 'auth:api'], function() {
    Route::post('details', 'api\UserController@details'); 
    Route::get('bao-cao-khan-cap','api\UrgentReportController@index')->name('list_report');
    Route::get('bao-cao-khan-cap','api\UrgentReportController@create')->name('create_report');   
    Route::post('bao-cao-khan-cap','api\UrgentReportController@store')->name('store_report');   
});

