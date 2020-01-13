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
    // User
    Route::resource('Users', 'api\UserController');
    Route::post('details', 'api\UserController@details');
    // Urgent Reports
    Route::resource('UrgentReports', 'api\UrgentReportController');
    // serious problem types
    Route::resource('SeriousProblemTypes', 'api\SeriousProblemTypes');
    // Hospital
    Route::resource('Hospitals', 'api\HospitalsController');
});

