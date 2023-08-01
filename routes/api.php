<?php

use App\Http\Controllers\Api\Auth\ForgetController;
use App\Http\Controllers\Api\Auth\GoogleLoginController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\ReSendController;
use App\Http\Controllers\Api\Auth\ResetController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('auth/login/social', [GoogleLoginController::class, 'loginNormal']);
Route::post('auth/login/socialTab', [GoogleLoginController::class, 'loginWithTab']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('dashboard', [DashboardController::class, 'dashboard']);

    Route::get('word/learn', [WordController::class, 'learn']);
    Route::post('word/pickup', [WordController::class, 'pickup']);
    Route::post('word/new', [WordController::class, 'store']);

    Route::post('exam', [ExamController::class, 'index']);
    Route::get('exam/{exam}', [ExamController::class, 'show']);
    Route::post('exam/make', [ExamController::class, 'make']);

    Route::get('user/word', [UserController::class, 'words']);

    Route::get('profile', [ProfileController::class, 'index']);
    Route::patch('profile', [ProfileController::class, 'update']);
    Route::patch('profile/password', [ProfileController::class, 'updatePassword']);

    Route::post('contact', [ContactController::class, 'store']);
});

Route::post('user/auth/login', [LoginController::class, 'login']);
Route::post('user/auth/resend', [ReSendController::class, 'resend']);
Route::post('user/auth/forget', [ForgetController::class, 'forget']);
Route::post('user/auth/reset', [ResetController::class, 'reset']);
