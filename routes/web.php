<?php

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

Route::get('/', function () {
    return view('front.welcome');
});

Auth::routes();

Route::get('/test', [App\Http\Controllers\TestController::class, 'index'])->name('test');
Route::get('/test/login', [App\Http\Controllers\TestController::class, 'login'])->name('test.login');
Route::get('/test/callback', [App\Http\Controllers\TestController::class, 'callback'])->name('test.callback');
Route::get('/test/translate', [App\Http\Controllers\TestController::class, 'translate'])->name('test.translate');

Route::get('/acf/test', [App\Http\Controllers\AcfController::class, 'test']);
