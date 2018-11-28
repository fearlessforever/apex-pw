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

Route::get('/', function () {
    return redirect(route('login'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'Auth\LoginController@logout')->name('auth.logout');

Route::prefix('profile')->group(function ($route) {
    Route::get('settings', 'Profile\SettingsController@index')->name('profile.settings');
    Route::post('settings', 'Profile\SettingsController@update')->name('profile.update');
    Route::get('password', 'Profile\PasswordController@index')->name('profile.password');
    Route::post('password', 'Profile\PasswordController@updatePassword')->name('password.update');
});
