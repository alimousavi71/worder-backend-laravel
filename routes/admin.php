<?php

// Login
use App\Http\Controllers\Admin\Acf\BuildController;
use App\Http\Controllers\Admin\Acf\BuilderController;
use App\Http\Controllers\Admin\Acf\FieldController;
use App\Http\Controllers\Admin\Acf\RenderController;
use App\Http\Controllers\Admin\Acf\TemplateController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AvatarController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PageController;
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
        Route::get('/category/{category}/edit', 'edit')->name('category.edit');
        Route::get('/category/{category}/show', 'show')->name('category.show');
        Route::patch('/category/{category}/update', 'update')->name('category.update');
        Route::delete('/category/{category}/destroy', 'destroy')->name('category.destroy');
    });

    Route::controller(PageController::class)->group(function () {
        Route::get('/page', 'index')->name('page.index');
        Route::get('/page/data', 'data')->name('page.data');
        Route::get('/page/create', 'create')->name('page.create');
        Route::post('/page/store', 'store')->name('page.store');
        Route::get('/page/{page}/edit', 'edit')->name('page.edit');
        Route::get('/page/{page}/show', 'show')->name('page.show');
        Route::patch('/page/{page}/update', 'update')->name('page.update');
        Route::delete('/page/{page}/destroy', 'destroy')->name('page.destroy');
    });

    Route::group(['as' => 'acf.', 'prefix' => 'acf'], function () {
        Route::controller(TemplateController::class)->group(function () {
            Route::get('/template', 'index')->name('template.index');
            Route::get('/template/data', 'data')->name('template.data');
            Route::get('/template/create', 'create')->name('template.create');
            Route::post('/template/store', 'store')->name('template.store');
            Route::get('/template/{template}/manage', 'manage')->name('template.manage')->whereNumber('template');
            Route::get('/template/{template}/edit', 'edit')->name('template.edit')->whereNumber('template');
            Route::patch('/template/{template}/update', 'update')->name('template.update')->whereNumber('template');
            Route::delete('/template/{template}/destroy', 'destroy')->name('template.destroy')->whereNumber('template');
        });

        Route::controller(RenderController::class)->group(function () {
            Route::get('/template/{type}/render', 'render')->name('template.render');
        });

        Route::controller(FieldController::class)->group(function () {
            Route::patch('/field/{template}/attach', 'attach')->name('field.attach');
            Route::get('/field/{fieldId}/delete', 'delete')->name('field.delete')
                ->whereNumber('fieldId');
        });

        Route::controller(BuildController::class)->group(function () {
            Route::get('/build', 'index')->name('build.index');
            Route::get('/build/data', 'data')->name('build.data');
            Route::get('/build/create', 'create')->name('build.create');
            Route::post('/build/store', 'store')->name('build.store');
            Route::get('/build/{build}/edit', 'edit')->name('build.edit');
            Route::patch('/build/{build}/update', 'update')->name('build.update');
            Route::delete('/build/{build}/destroy', 'destroy')->name('build.destroy');
        });

        Route::controller(BuilderController::class)->group(function () {
            Route::get('/builder/{build}', 'index')->name('builder')->whereNumber('build');
            Route::get('/builder/{build}/{template}/add', 'addTemplate')->name('builder.add')->whereNumber(['build', 'template']);
            Route::get('/builder/{build}/{template}/remove', 'removeTemplate')->name('builder.remove')->whereNumber(['build', 'template']);
            Route::patch('/builder/{build}/save', 'save')->name('builder.save')->whereNumber('build');
        });
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
