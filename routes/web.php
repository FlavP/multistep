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
Route::group(['middleware' => 'web'], function () {


//    Route::get('/', function () {
//        return view('welcome');
//    });

    Route::get('/operations', 'StaffController@index')->middleware('operator');

    Auth::routes(['register' => false]);

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('profile/{any}', 'HomeController@index')->where('any', '.*');
});
