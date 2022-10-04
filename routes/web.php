<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/main', 'App\Http\Controllers\MainController@main');
Route::get('/index', 'App\Http\Controllers\MainController@successlogin');
Route::post('main/checklogin', 'App\Http\Controllers\MainController@checklogin');
Route::get('main/logout', 'App\Http\Controllers\MainController@logout');
Route::get('/register', 'App\Http\Controllers\MainController@register');
Route::post('main/signup', 'App\Http\Controllers\MainController@signup');
Route::get('/update', 'App\Http\Controllers\MainController@update_info');
Route::post('main/updatedetails', 'App\Http\Controllers\MainController@updatedetails');
Route::post('main/updatepassword', 'App\Http\Controllers\MainController@updatepassword');
Route::get('/forgotpassword','App\Http\Controllers\MainController@forgotpassword');
Route::post('main/forgot_password','App\Http\Controllers\MainController@forgot_password');
Route::get('/setnewpassword/{email}','App\Http\Controllers\MainController@setnewpassword');
Route::post('main/set_password','App\Http\Controllers\MainController@set_password');
Route::get('/verificationpage','App\Http\Controllers\MainController@verificationpage');
Route::get('/verifyuser','App\Http\Controllers\MainController@verifyuser');
//function (){
   // return view('register');
//});