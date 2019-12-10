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

    Route::get('/operations/{vue_routing?}', function (){
        return view('operations');
    })->where('vue_routing', '[\/\w.-]*')->middleware('operator');
    Route::get('/get-clients', 'StaffController@getClients');

    Auth::routes(['register' => false]);

    Route::get('/', 'HomeController@index')->name('home');

    // User Profile Routes
    Route::get('/profile/{any}', 'HomeController@index')->where('any', '.*');
    Route::get('/export-clients', 'ClientController@export');
    Route::post('/profile-picture', 'StaffController@changePicture');
    Route::post('/set-user', 'StaffController@setUser');
});
