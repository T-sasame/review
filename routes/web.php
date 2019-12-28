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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::get('review/create', 'Admin\ReviewController@add');
    Route::post('review/create', 'Admin\ReviewController@create');
    Route::get('review', 'Admin\ReviewController@mypage');
    Route::get('review/edit', 'Admin\ReviewController@edit');
    Route::post('review/edit', 'Admin\ReviewController@update');
    Route::get('review/delete', 'Admin\ReviewController@delete');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'MainController@index');
Route::get('/detail', 'MainController@detail');
Route::get('/register', 'MainController@new_user')->name('register');
