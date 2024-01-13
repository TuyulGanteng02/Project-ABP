<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function() {
    return view('sesi/welcome');
})->middleware('isguest');

Route::resource('buku', BukuController::class)->middleware('islogin');

Route::get('/sesi',[SessionController::class, 'index'])->middleware('isguest');
Route::post('/sesi/login',[SessionController::class, 'login'])->middleware('isguest');
Route::get('/sesi/logout',[SessionController::class, 'logout']);
Route::get('/sesi/register',[SessionController::class, 'register'])->middleware('isguest');
Route::post('/sesi/create',[SessionController::class, 'create'])->middleware('isguest');
