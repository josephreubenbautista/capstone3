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

Route::get('/leagues/{leagueid}/players/{teamid}', 'LeagueController@teamplayers');

Route::get('/leagues/{id}/games', 'LeagueController@games');

Route::get('/leagues/{leagueid}/games/{gameid}', 'LeagueController@gamedetails');
Route::get('/leagues/{leagueid}/games/{gameid}/edit', 'LeagueController@gamedetailsedit');

Route::post('/leagues/{leagueid}/games/{gameid}/update/{statid}', 'LeagueController@gamedetailsupdate');
Route::post('/leagues/{leagueid}/games/{gameid}/standings', 'LeagueController@standings');



Route::resource('/teams','TeamController');



Route::resource('/players','PlayerController');

Route::resource('/games','GameController');