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
Route::post('/ticket/load-file', 'TicketController@uploadFile')->name('upload-file');
Route::get('/ticket/show/{ticket}', 'TicketController@show')->name('show-ticket');
Route::get('/ticket/solicitados', 'TicketController@list')->name('my-tickets');
Route::get('/ticket/take/{ticket}', 'TicketController@take')->name('take-ticket');
Route::delete('/ticket/{ticket}', 'TicketController@delete')->name('ticket-delet');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/ticket/index', 'HomeController@list')->name('index-ticket');


//  rutas para usuarios
Route::get('/user/new', 'UserController@new')->name('new-user');
Route::get('/users/index', 'UserController@index')->name('index-user');
Route::get('/users/user/{user}', 'UserController@show')->name('see-user');
Route::post('/user/create', 'UserController@create')->name('user-create');

Route::post('/logout', 'UserController@logout')->name('logout');
