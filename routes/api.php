<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/key', 'App\Http\Controllers\MainController@getTokenapi');
Route::get('/search', 'App\Http\Controllers\MainController@dosearchapi');
