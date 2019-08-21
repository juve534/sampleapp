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

$prefix = 'v1';
Route::group(['prefix' => $prefix], function () {
    Route::get('posts', 'Posts\\IndexAction');
    Route::get('posts/{id}', 'Posts\\ShowAction');
    Route::post('review', 'Review\\RegisterAction');
});
