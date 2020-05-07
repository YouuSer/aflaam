<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'MoviesController@index')->name('movies.index');
Route::get('/movies/{id}', 'MoviesController@show')->name('movies.show');

Route::get('/tv', 'TvController@index')->name('tv.index');
Route::get('/tv/{id}', 'TvController@show')->name('tv.show');

Route::get('/persons', 'PersonsController@index')->name('persons.index');
Route::get('/persons/page/{page?}', 'PersonsController@index');

Route::get('/persons/{id}', 'PersonsController@show')->name('persons.show');
