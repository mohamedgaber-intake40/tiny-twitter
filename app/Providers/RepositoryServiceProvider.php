<?php

namespace App\Providers;

use App\Repositories\AccessTokenRepository;
use App\Repositories\Interfaces\AccessTokenRepositoryInterface;
use App\Repositories\Interfaces\TweetRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\TweetRepository;
use App\Repositories\UserRepository;
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
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
        $this->app->bind(AccessTokenRepositoryInterface::class,AccessTokenRepository::class);
        $this->app->bind(TweetRepositoryInterface::class,TweetRepository::class);
    }
}
