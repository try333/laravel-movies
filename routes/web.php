<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\TvController;

Route::get('/', [MoviesController::class, 'index']);
Route::post('/', 'MoviesController@index')->name('movies.index');
Route::get('/tv', [TvController::class, 'index']);
Route::post('/tv', 'TvController@index')->name('tv.index');

Route::get('/movies/{movie}', [MoviesController::class, 'show']);
Route::post('/movies/{movie}', 'MoviesController@show')->name('movies.show');
Route::get('/tv/{tv}', [TvController::class, 'show']);
Route::post('/tv/{tv}', 'TvController@show')->name('tv.show');