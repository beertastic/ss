<?php

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

Route::prefix('v1')->group(function () {

    // get channel list
    Route::get('channels', 'Api\ChannelsController@list');

    // get programme timetable
    // (filter 3rd GET var as it needs to be a date and does interfere with next route)
    Route::get('channels/{cuid}/{date}/{timezone}', 'Api\ScheduleController@list')
        ->where('date', '([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))');;

    // get program info
    Route::get('channels/{cuid}/programmes/{puid}', 'Api\EpisodeController@get');

});
