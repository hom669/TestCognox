<?php

use Illuminate\Support\Facades\Route;
use GuzzleHttp\Client;
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


    //dd($response);

    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/home', function () {
    return view('dashboard');
})->name('dashboard');


Route::middleware(['auth:sanctum', 'verified'])->resource('transactions', 'App\Http\Controllers\TransactionController');
Route::post('transactions/store', 'App\Http\Controllers\TransactionController@store');

Route::middleware(['auth:sanctum', 'verified'])->resource('stateaccount','App\Http\Controllers\StateAccountController');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

