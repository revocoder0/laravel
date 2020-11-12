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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//Posts and create
Route::get('/posts', 'PostController@index')->name('post'); 
Route::get('/create', 'PostController@create')->name('create');
Route::post('/create', 'PostController@store')->name('store');

//show
Route::get('/postdetials/{id}', 'PostController@show')->name('show');

//edit and delete
Route::get('/edit/{id}', 'PostController@edit')->name('edit');
Route::post('/edit/{id}', 'PostController@update')->name('update');
Route::get('/delete/{id}', 'PostController@destroy')->name('destroy');


//profile
Route::get('/profile/{id}', 'UserController@profile')->name('profile');
//Category
Route::get('/category', 'CategoryController@create')->name('catcategory');
Route::post('/category', 'CategoryController@store')->name('catstore');