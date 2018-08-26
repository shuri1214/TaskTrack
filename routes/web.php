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
	return redirect('/performances');
});

Route::get('/tasks', 'TaskController@index');
Route::post('/tasks', 'TaskController@store');
Route::delete('/tasks/{id}', 'TaskController@destroy');

Route::get('/performances', 'PerformanceController@index');
Route::post('/timer/start/{id}', 'MeasureController@start');
Route::post('/timer/stop/{id}', 'MeasureController@end');
Route::post('/performance/{id}', 'PerformanceController@regist');

\URL::forceScheme('https');

