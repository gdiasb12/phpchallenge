<?php

use Illuminate\Support\Facades\Route;

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
	// $file = "storage/xml/people.xml";
	// $xml = simplexml_load_file($file);

	// return response()->Json($xml);
	// $xml = simplexml_load_string($string);

	// $json = json_encode($xml);

	// $array = json_decode($json,TRUE);

	// return [$json, $array];
	return view('welcome');
});

Route::resource('document', 'DocumentController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
