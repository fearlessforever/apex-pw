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

Route::middleware('auth')->group(function ($route) {
    Route::prefix('profile')->group(function ($route) {
        Route::get('settings', 'Profile\SettingsController@index')->name('profile.settings');
        Route::post('settings', 'Profile\SettingsController@update')->name('profile.update');
        Route::get('password', 'Profile\PasswordController@index')->name('profile.password');
        Route::post('password', 'Profile\PasswordController@updatePassword')->name('password.update');
    });

    Route::prefix('donate')->group(function ($route) {
        Route::get('/', 'Donate\RequestController@index')->name('donate.request');
        Route::post('/', 'Donate\RequestController@store')->name('donate.store');
        Route::get('history', 'Donate\DonateController@index')->name('donate.history');
    });

    Route::namespace('User')
        ->group(function () {
            Route::resource('tickets', 'Ticket\TicketsController');
            Route::post('ticket/{ticket}/reply', 'Ticket\AddReplyController')->name('tickets.reply');
        });
});

Route::post('/payment_notification', 'Donate\NotificationsController@notification');
