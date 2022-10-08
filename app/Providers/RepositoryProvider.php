<?php

namespace App\Providers;

use App\Interfaces\Repositories\PostRepositoryInterface;
use App\Interfaces\Repositories\TagRepositoryInterface;
use App\Repository\Eloquent\PostRepository;
use App\Repository\Eloquent\TagRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            PostRepositoryInterface::class,
            PostRepository::class,
        );
        $this->app->bind(
            TagRepositoryInterface::class,
            TagRepository::class,
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
