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

use Carbon\Carbon;

Route::get('/', function() {
	$now = Carbon::now();
	$finish = Carbon::create(2018, 11, 23, 16, 0, 0, 'Europe/London');

	$interval = $now->diffAsCarbonInterval($finish);
	$left = '';
	$hours = $interval->h + ($interval->d * 24);
	
	if($hours > 0) {
		$left = $hours . str_plural(' hour', $hours);
	}
	if($interval->i > 0) {
		$left .= ' ' . $interval->i . str_plural(' minute', $interval->i);
	}
	if($left != '') {
		$left .= ' remaining';
	}

    return view('feed')->with('remaining', $left);
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
