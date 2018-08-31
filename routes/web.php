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
	return redirect('/tasks');
});

//Route::resource('users', 'UserController');

Route::get('/tasks', 'TaskController@index')->name('tasks');
Route::post('/tasks', 'TaskController@store');
Route::post('/tasks/{id}', 'TaskController@update');
Route::delete('/tasks/{id}', 'TaskController@destroy');

Route::get('/performances', 'PerformanceController@index')->name('performances');
Route::post('/timer/start/{id}', 'MeasureController@start');
Route::post('/timer/stop/{id}', 'MeasureController@end');
Route::post('/performance/{measure_id}/task/{task_id}', 'PerformanceController@regist');
Route::post('/performance/{measure_id}/newtask', 'PerformanceController@registwithtask');

\URL::forceScheme('https');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
