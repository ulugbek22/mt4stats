<?php

use Illuminate\Support\Facades\Route;

Route::get( '/', 'Stats@index' );
Route::post( '/stats', 'Stats@store' );
Route::get( '/stats', 'Stats@create' );
Route::get( '/stats/graphs', 'Stats@graphs' );
Route::get( '/stats/{stat}', 'Stats@show' );
Route::get( '/stats/{stat}/delete', 'Stats@destroy' );