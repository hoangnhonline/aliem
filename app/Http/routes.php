<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/xvideos', ['uses' => 'CrawlerController@xvideos', 'as' => 'xvideos']);
Route::get('/images-xvideos', ['uses' => 'CrawlerController@imageXvideos', 'as' => 'images-xvideos']);
require (__DIR__ . '/Routes/frontend.php');
require (__DIR__ . '/Routes/backend.php');