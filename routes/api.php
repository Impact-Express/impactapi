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
Auth::routes();
Route::middleware('auth:api', 'throttle:30,1', 'customer')->post('/UploadManifest', 'ManifestController@store');
Route::get('/UploadManifest', function() { abort(404); });
Route::put('/UploadManifest', function() { abort(404); });
Route::delete('/UploadManifest', function() { abort(404); });
Route::patch('/UploadManifest', function() { abort(404); });
Route::options('/UploadManifest', function() { abort(404); });
