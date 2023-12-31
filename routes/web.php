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

Route::get('invoices/{id}', 'App\Http\Controllers\API\InvoiceController@generateInvoice');
Route::get('invoices', 'App\Http\Controllers\API\InvoiceController@index');
