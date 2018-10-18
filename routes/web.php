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

Route::get('/sqlite', function () {
    return view('sqlite');
});

Route::get('/hello/{name}', function($name) {
	return "Hello $name";
});

Route::get('Tot/show', 'TotController@show');
Route::get('Tot/showall', 'TotController@showall');
Route::get('Tot/showall2', 'TotController@showall2');
Route::get('Tot/insf', 'TotController@insf');
Route::post('Tot/ins', 'TotController@ins');

Route::get('/form',function(){
   return view('form');
});

Route::get('/form1',function(){ return view('form1'); });
Route::get('/form2',function(){ return view('form2'); });
Route::get('/form3',function(){ return view('form3'); });
Route::get('/form4',function(){ return view('form4'); });
Route::get('/form5',function(){ return view('form5'); });

Route::post('foo', 'TotController@processfoo');
Route::post('/foo_old', function() { return "Hello Foo"; });
Route::get('bar-chart', 'ChartController@index');

Route::get('sm/dash', 'SMController@dash');
Route::get('sm/show', 'SMController@show');
Route::get('sm/showall', 'SMController@showall');
Route::get('sm/showall2', 'SMController@showall2');
Route::get('sm/insf', 'SMController@insf');
Route::post('sm/ins', 'SMController@ins');

Route::get('tot/daily', 'NTotController@daily');
Route::get('tot/today', 'NTotController@today');
Route::get('tot/detail', 'NTotController@detail');
Route::get('tot/accnt/{accnt}', ['uses' => 'NTotController@detail'] );
Route::get('tot/totf', 'NTotController@totf');
Route::get('tot/pub/{yymmdd}', ['uses' => 'NTotController@pub'] );
Route::get('tot/sync', 'NTotController@sync');
Route::get('tot/serialize', 'NTotController@serialize');
