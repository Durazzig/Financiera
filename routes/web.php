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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Rutas Clientes
Route::get('/clients', 'ClientsController@index')
    ->name('clients.index');
Route::get('/clients/new', 'ClientsController@create')
    ->name('clients.create');
Route::post('/clients', 'ClientsController@store')
    ->name('clients.store');
Route::delete('/clients/{id}', 'ClientsController@destroy')
    ->name('clients.destroy');
Route::any('/clients/edit/{id}', 'ClientsController@edit');
Route::any('/clients/update/{id}', 'ClientsController@update')->name('clients.update');

//Rutas Prestamos
Route::get('/loans', 'LoansController@index')->name('loans.index');
Route::get('/loans/create', 'LoansController@create')->name('loans.create');
Route::any('/loans/store', 'LoansController@store')->name('loans.store');

//Rutas Pagos
Route::get('/payments', 'PaymentController@index')->name('payments.index');
Route::any('/payments/list/{id}', 'PaymentController@list');
Route::get('/payments/abonar', 'PaymentController@abonar')->name('payments.abonar');
Route::post('/payments/abonar/{id}', 'PaymentController@update')->name('payments.update');