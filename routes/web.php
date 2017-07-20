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
    return view('layouts.material.app');
});

Auth::routes();

Route::get('/', 'PagesController@index');
Route::get('/home', 'PagesController@index');
Route::get('/index', 'PagesController@index');
Route::get('/about', 'PagesController@about');

Route::get('/faq', 'FaqController@index');

Route::get('/cart', 'CartController@index');
Route::get('/contact', 'ContactController@index');
Route::get('/packages', 'PackagesController@index');

Route::get('/quote', 'QuoteController@index');

Route::resource('/treats', 'TreatsController');