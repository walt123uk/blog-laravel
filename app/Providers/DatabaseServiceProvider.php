<?php


namespace App\Providers;

use App\Repositories\PostRepository;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class DatabaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            PostRepositoryInterface::class,
            PostRepository::class
        );
    }
}
