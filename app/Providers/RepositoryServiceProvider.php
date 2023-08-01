<?php

namespace App\Providers;

use App\Repositories\ContactRepo;
use App\Repositories\ExamRepo;
use App\Repositories\IContactRepo;
use App\Repositories\IExamRepo;
use App\Repositories\ISentenceRepo;
use App\Repositories\IUserRepo;
use App\Repositories\IWordRepo;
use App\Repositories\SentenceRepo;
use App\Repositories\UserRepo;
use App\Repositories\WordRepo;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(IUserRepo::class, UserRepo::class);
        $this->app->bind(IWordRepo::class, WordRepo::class);
        $this->app->bind(IExamRepo::class, ExamRepo::class);
        $this->app->bind(ISentenceRepo::class, SentenceRepo::class);
        $this->app->bind(IContactRepo::class, ContactRepo::class);
    }
}
