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
    return view('articles.index');
});

Auth::routes();

Route::get('/allArticles','ArticleController@index')->name('all-articles');
Route::get('/userArticles','UserController@index')->name('articles-by-user');
Route::get('/singleArticle/{id}','ArticleController@show')->name('single-article');
Route::get('/create', 'ArticleController@create')->name('create')->middleware('auth');
Route::post('/create', 'ArticleController@store')->name('store')->middleware('auth');
Route::delete('article/{id}', 'ArticleController@destroy')->name('destroy')->middleware('auth');

