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
    return view('feed');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/add', function () {
    return view('manage.add');
});

//post request for uploading audio, sends request to uploadPost function in the postController
Route::post('/manage/add','PostController@uploadPost')->name('upload-post');
