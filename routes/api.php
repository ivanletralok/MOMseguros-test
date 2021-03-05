<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;  
use App\Http\Controllers\PostController;




Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/post', 'PostController@index');
Route::get('/post/{id}', 'PostController@show');
Route::put('/post/{id}', 'PostController@update');
Route::delete('/post/{id}', 'PostController@destroy');  
Route::post('/posts', 'PostController@store');  
