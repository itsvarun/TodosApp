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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/say-hello', function () {
	return "Hello, there big boy.";
});

Route::get('/say-hello/{name}', 'HomeController@sayHello');


Route::get('/todos', 'TodosController@index')->name('todos.list');

Route::post('/todos', 'TodosController@store')->name('todos.create');

Route::patch('/todos/{todo}/complete', 'TodosController@complete')->name('todos.complete');

Route::patch('/todos/{todo}/pending', 'TodosController@pending')->name('todos.pending');

Route::delete('/todos/{todo}', 'TodosController@destroy')->name('todos.delete');

// Route::get('/home', 'HomeController@index')->name('home');

Route::redirect('/home', '/todos');


Route::view('/vue', 'vue')->name('vue');

Route::any('/any', function() {
	return "any works";
});

Route::match(['GET', 'POST'], '/match', function() {
	return "match works";
});

Route::get('/test', function() {
	return App\User::select('id', 'name', 'email', 'created_at')->get();
});

