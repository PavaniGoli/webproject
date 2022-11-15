<?php

use Illuminate\Support\Facades\Route;
use Elastic\Elasticsearch;
use Elastic\Elasticsearch\ClientBuilder;
use App\Http\Controllers\FileUpload;
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
    $client = ClientBuilder::create();
    var_dump($client);
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
Route::get('/serp','App\Http\Controllers\MainController@searchpage');
Route::get('/see','App\Http\Controllers\MainController@seepage');
Route::post('/searchword','App\Http\Controllers\MainController@searchword');
Route::post('/loginserp','App\Http\Controllers\MainController@loginsearch');
Route::get('/download','App\Http\Controllers\MainController@download');
Route::get('/summary','App\Http\Controllers\MainController@summary');
Route::get('/loginsummary','App\Http\Controllers\MainController@loginsummary');
Route::get('/insert','App\Http\Controllers\MainController@insert');
Route::post('/add_data','App\Http\Controllers\MainController@add_data');

// Route::get('fileUpload', function () 
// {
//     return view('fileUpload');
// })->name('fileUpload');
Route::get('/upload-file','App\Http\Controllers\FileUpload@createForm');
Route::post('/upload-file','App\Http\Controllers\FileUpload@fileUpload')->name('fileUpload');




