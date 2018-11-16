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

Route::get('/', function() {
    return view('feed');
})->name('feed');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::get('/','PostController@getAllPostHTML')->name('generatePosts');
Route::get('/post', 'PostController@getPostPage')->name('post');



Route::get('/add', function () {
    return view('manage.add');
});

//login controller routing
Route::post('/auth/login','Auth\LoginController@postLogin')->name('post-login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');


//post request for uploading audio, sends request to uploadPost function in the postController
Route::post('/manage/add','PostController@uploadPost')->name('upload-post');
