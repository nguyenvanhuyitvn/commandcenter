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


Route::post('login', 'api\UserController@login')->name('login')->middleware('cors');
Route::get('register', 'api\UserController@get_register')->name('register')->middleware('cors');
Route::post('register', 'api\UserController@register')->name('register')->middleware('cors');
Route::group(['middleware' => 'auth:api'], function() {
    // User
    Route::resource('Users', 'api\UserController')->middleware('cors');
    Route::post('details', 'api\UserController@details')->middleware('cors');
    // Urgent Reports
    Route::resource('UrgentReports', 'api\UrgentReportController')->middleware('cors');
    // serious problem types
    Route::resource('SeriousProblemTypes', 'api\SeriousProblemTypes')->middleware('cors');
    // Hospital
    Route::resource('Hospitals', 'api\HospitalsController')->middleware('cors');
    Route::resource('Depts', 'api\DeptController')->middleware('cors');
    Route::resource('Positions', 'api\PositionController')->middleware('cors');
});

