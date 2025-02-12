<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes(['register' => false]);

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function() {
    Route::prefix('apiuser')->group(function() {
        Route::get('{ApiUser}', 'ApiUserController@profile')->name('apiuser.profile');
        Route::post('{ApiUser}/edit/name', 'ApiUserController@store')->name('apiuser.edit.name');
        Route::post('{ApiUser}/edit/username', 'ApiUserController@store')->name('apiuser.edit.username');
        Route::post('{ApiUser}/edit/accountnumber', 'ApiUserController@store')->name('apiuser.edit.accountnumber');
        Route::post('{ApiUser}/edit/apitoken', 'ApiUserController@store')->name('apiuser.edit.apitoken');
        Route::post('/', 'ApiUserController@create')->name('apiuser.new');
        Route::post('{ApiUser}/delete', 'ApiUserController@delete')->name('apiuser.delete');
    });
    Route::prefix('manifest')->group(function() {
        Route::get('{manifest}', 'ManifestController@show')->name('manifest.show');
        Route::get('{manifest}/download', 'ManifestController@download')->name('manifest.download');
    });
    Route::get('generateApiToken','ApiTokenController@generate');
});
