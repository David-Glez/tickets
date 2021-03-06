<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

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
    return view('auth.signin');
});

Auth::routes();

//  rutas para los tickets
Route::get('/ticket/new', 'TicketController@new')->name('new-ticket');
Route::post('/ticket', 'TicketController@create')->name('ticket-create');
Route::get('/ticket/show/{ticket}', 'TicketController@show')->name('show-ticket');
Route::get('/ticket/solicitados', 'TicketController@list')->name('my-tickets');
Route::get('/ticket/take/{ticket}', 'TicketController@take')->name('take-ticket');
Route::delete('/ticket/{ticket}', 'TicketController@reject_ticket')->name('reject-ticket');
Route::get('/ticket/detalles/{id}', 'TicketController@details')->name('ticket-details');
Route::post('/ticket/commit', 'TicketController@commit')->name('commit-ticket');
Route::delete('/ticket/remove/{ticket}', 'TicketController@remove')->name('destroy-ticket');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/ticket/index', 'HomeController@list')->name('index-ticket');

//  logs
Route::get('/actividad', 'HomeController@logs')->name('activity');

//  rutas para usuarios
Route::get('/users/new', 'UserController@new')->name('new-user');
Route::get('/users/index', 'UserController@index')->name('index-user');
Route::get('/users/show/{user}', 'UserController@show')->name('see-user');
Route::post('/user/create', 'UserController@create')->name('user-create');
Route::delete('/user/delete/{user}', 'UserController@destroy')->name('user-delete');
Route::get('/user/modify/{user}', 'UserController@edit')->name('user-modify');
Route::post('/user/edit', 'UserController@update')->name('user-edit');

Route::post('/logout', 'UserController@logout')->name('logout');
Route::post('/login', 'UserController@login')->name('signin');
