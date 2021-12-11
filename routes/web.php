<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index']);;

Auth::routes();

//Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/lab1', [HomeController::class, 'indexLab1'])->name('lab1');
Route::get('/lab1/result', [HomeController::class, 'lab1'])->name('lab1.result');

Route::get('/lab2', [HomeController::class, 'indexLab2'])->name('lab2');
Route::get('/lab2/result', [HomeController::class, 'lab2'])->name('lab2.result');

