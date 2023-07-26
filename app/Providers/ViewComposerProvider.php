<?php

namespace App\Providers;

use App\Http\ViewComposers\Admin\User\UserComposer;
use Illuminate\Support\ServiceProvider;

class ViewComposerProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['admin.user.create','admin.user.edit'],UserComposer::class);
    }
}
