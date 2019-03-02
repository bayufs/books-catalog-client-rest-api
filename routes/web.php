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

route::get('/', 'BookStoreController@index');\
Route::get('/detail/{id}', 'BookStoreController@show')->name('books.detail');
Route::get('/page/category/{id}', 'BooksByCategoryController@getBooksByCategory')->name('books.category');
Route::post('/registration', 'BooksAuthController@register');
Route::post('/signin', 'BooksAuthController@login');

Route::get('/login', 'BooksAuthController@showLoginForm');
Route::get('/register', 'BooksAuthController@showRegisterForm');
Route::get('/logout', 'BooksAuthController@logout');

Route::group(['prefix' => 'admin'], function () {
    Route::get('dashboard', 'admin\BookStoreAdminController@index');
    Route::get('form-add-new-book', 'admin\BookStoreAdminController@create');
    Route::post('add-new-book', 'admin\BookStoreAdminController@store');
    Route::get('delete-book/{id}', 'admin\BookStoreAdminController@destroy');
    Route::get('edit-book/{id}', 'admin\BookStoreAdminController@edit');
    Route::put('edit-book', 'admin\BookStoreAdminController@update');
});



// Route::get('/home', 'HomeController@index')->name('home');
