<?php

// Login
use App\Http\Controllers\Admin\AcfFieldAttachController;
use App\Http\Controllers\Admin\AcfTemplateController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AvatarController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SentenceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WordController;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Http\Controllers\Admin'], function () {
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    // Reset Password
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

    // Confirm Password
    Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
    Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');
});

Route::group(['middleware' => ['admin.auth'/*,'acl'*/], 'guard' => 'admin'], function () {
    /* this function for help to route ui dashboard */
    Route::get('/', [HomeController::class, 'redirect'])->name('home');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/permission/sync', [PermissionController::class, 'sync'])->name('permission.sync');

    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin', 'index')->name('admin.index');
        Route::get('/admin/data', 'data')->name('admin.data');
        Route::get('/admin/create', 'create')->name('admin.create');
        Route::post('/admin/store', 'store')->name('admin.store');
        Route::get('/admin/show/{admin}', 'show')->name('admin.show');
        Route::get('/admin/edit/{admin}', 'edit')->name('admin.edit');
        Route::patch('/admin/update/{admin}', 'update')->name('admin.update');
        Route::delete('/admin/destroy/{admin}', 'destroy')->name('admin.destroy');
    });

    Route::controller(RoleController::class)->group(function () {
        Route::get('/role', 'index')->name('role.index');
        Route::get('/role/data', 'data')->name('role.data');
        Route::get('/role/create', 'create')->name('role.create');
        Route::post('/role/store', 'store')->name('role.store');
        Route::get('/role/edit/{role}', 'edit')->name('role.edit');
        Route::patch('/role/update/{role}', 'update')->name('role.update');
        Route::delete('/role/destroy/{role}', 'destroy')->name('role.destroy');
    });

    Route::controller(SentenceController::class)->group(function () {
        Route::get('/sentence', 'index')->name('sentence.index');
        Route::get('/sentence/data', 'data')->name('sentence.data');
        Route::get('/sentence/create', 'create')->name('sentence.create');
        Route::post('/sentence/store', 'store')->name('sentence.store');
        Route::get('/sentence/edit/{sentence}', 'edit')->name('sentence.edit');
        Route::get('/sentence/show/{sentence}', 'show')->name('sentence.show');
        Route::patch('/sentence/update/{sentence}', 'update')->name('sentence.update');
        Route::delete('/sentence/destroy/{sentence}', 'destroy')->name('sentence.destroy');
    });

    Route::controller(WordController::class)->group(function () {
        Route::get('/word', 'index')->name('word.index');
        Route::get('/word/data', 'data')->name('word.data');
        Route::get('/word/create', 'create')->name('word.create');
        Route::post('/word/store', 'store')->name('word.store');
        Route::get('/word/edit/{word}', 'edit')->name('word.edit');
        Route::get('/word/show/{word}', 'show')->name('word.show');
        Route::patch('/word/update/{word}', 'update')->name('word.update');
        Route::delete('/word/destroy/{word}', 'destroy')->name('word.destroy');
    });

    Route::controller(ExamController::class)->group(function () {
        Route::get('/exam', 'index')->name('exam.index');
        Route::get('/exam/data', 'data')->name('exam.data');
        Route::get('/exam/create', 'create')->name('exam.create');
        Route::post('/exam/store', 'store')->name('exam.store');
        Route::get('/exam/edit/{exam}', 'edit')->name('exam.edit');
        Route::get('/exam/show/{exam}', 'show')->name('exam.show');
        Route::patch('/exam/update/{exam}', 'update')->name('exam.update');
        Route::delete('/exam/destroy/{exam}', 'destroy')->name('exam.destroy');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'index')->name('category.index');
        Route::get('/category/data', 'data')->name('category.data');
        Route::get('/category/create', 'create')->name('category.create');
        Route::post('/category/store', 'store')->name('category.store');
        Route::get('/category/edit/{category}', 'edit')->name('category.edit');
        Route::get('/category/show/{category}', 'show')->name('category.show');
        Route::patch('/category/update/{category}', 'update')->name('category.update');
        Route::delete('/category/destroy/{category}', 'destroy')->name('category.destroy');
    });

    Route::controller(AcfTemplateController::class)->group(function () {
        Route::get('/acf-template', 'index')->name('acf-template.index');
        Route::get('/acf-template/data', 'data')->name('acf-template.data');
        Route::get('/acf-template/create', 'create')->name('acf-template.create');
        Route::post('/acf-template/store', 'store')->name('acf-template.store');

        Route::get('/acf-template/{type}/render', 'render')->name('acf-template.render');
        Route::get('/acf-template/{acfTemplate}/edit', 'edit')->name('acf-template.edit');
        Route::get('/acf-template/{acfTemplate}/manage', 'manage')->name('acf-template.manage');
        Route::patch('/acf-template/{acfTemplate}/update', 'update')->name('acf-template.update');
        Route::delete('/acf-template/{acfTemplate}/destroy', 'destroy')->name('acf-template.destroy');
    });

    Route::controller(AcfFieldAttachController::class)->group(function () {
        Route::patch('/acf-template/{acfTemplate}/store-fields', 'store')->name('acf-template.store-fields');
    });

    Route::controller(AvatarController::class)->group(function () {
        Route::get('/avatar', 'index')->name('avatar.index');
        Route::get('/avatar/data', 'data')->name('avatar.data');
        Route::get('/avatar/create', 'create')->name('avatar.create');
        Route::post('/avatar/store', 'store')->name('avatar.store');
        Route::post('/avatar/sort-item', 'sortItem')->name('avatar.sort-item');
        Route::get('/avatar/edit/{avatar}', 'edit')->name('avatar.edit');
        Route::patch('/avatar/update/{avatar}', 'update')->name('avatar.update');
        Route::delete('/avatar/destroy/{avatar}', 'destroy')->name('avatar.destroy');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'index')->name('user.index');
        Route::get('/user/data', 'data')->name('user.data');
        Route::get('/user/edit/{user}', 'edit')->name('user.edit');
        Route::get('/user/show/{user}', 'show')->name('user.show');
        Route::patch('/user/update/{user}', 'update')->name('user.update');
        Route::delete('/user/destroy/{user}', 'destroy')->name('user.destroy');
    });

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('profile.index');
        Route::get('/profile/logout', 'logout')->name('profile.logout');
        Route::get('/profile/password', 'password')->name('profile.password');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::patch('/profile/password', 'updatePassword')->name('profile.password.update');
    });

    Route::controller(SentenceController::class)->group(function () {
        Route::get('/sentence', 'index')->name('sentence.index');
        Route::get('/sentence/data', 'data')->name('sentence.data');
        Route::get('/sentence/create', 'create')->name('sentence.create');
        Route::post('/sentence/store', 'store')->name('sentence.store');
        Route::get('/sentence/edit/{sentence}', 'edit')->name('sentence.edit');
        Route::get('/sentence/show/{sentence}', 'show')->name('sentence.show');
        Route::patch('/sentence/update/{sentence}', 'update')->name('sentence.update');
        Route::delete('/sentence/destroy/{sentence}', 'destroy')->name('sentence.destroy');
    });

    Route::controller(ContactController::class)->group(function () {
        Route::get('/contact', 'index')->name('contact.index');
        Route::get('/contact/data', 'data')->name('contact.data');
        Route::get('/contact/edit/{contact}', 'edit')->name('contact.edit');
        Route::patch('/contact/update/{contact}', 'update')->name('contact.update');
        Route::get('/contact/show/{contact}', 'show')->name('contact.show');
        Route::delete('/contact/destroy/{contact}', 'destroy')->name('contact.destroy');
    });

    Route::controller(ExamController::class)->group(function () {
        Route::get('/exam', 'index')->name('exam.index');
        Route::get('/exam/data', 'data')->name('exam.data');
        Route::get('/exam/show/{exam}', 'show')->name('exam.show');
        Route::delete('/exam/destroy/{exam}', 'destroy')->name('exam.destroy');
    });
});
