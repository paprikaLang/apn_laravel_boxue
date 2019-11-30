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
Route::prefix('v1')->group(function() {
    Route::get('public-key/version', 'KeyController@getPublicKeyVersion');
    Route::get('public-key', 'KeyController@getPublicKey');

    Route::resource('devices', 'DeviceController');
    Route::resource('notifications', 'NotificationController');
});
