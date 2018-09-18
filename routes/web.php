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

Route::get('/home', 'HomeController@index');


Route::resource('/leagues','LeagueController');
Route::get('/leagues/{id}/teams', 'LeagueController@teams');
Route::get('/leagues/{id}/players', 'LeagueController@players');



Route::resource('/teams','TeamController');



Route::resource('/players','PlayerController');