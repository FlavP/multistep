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
    Route::get('/', 'HomeController@index');

    Route::get('/operations', function (){
        return view('operations');
    })->middleware('operator');
    Route::get('/get-clients', 'StaffController@getClients');
    Route::get('/operations/check-email', 'StaffController@checkEmail');

    Auth::routes(['register' => false]);


    // User Profile Routes
    Route::get('/profile/{any}', 'HomeController@index')->where('any', '.*');
    Route::get('/export-clients', 'ClientController@export');
    Route::post('/profile-picture', 'StaffController@changePicture');
    Route::post('/set-user', 'StaffController@setUser');
});
