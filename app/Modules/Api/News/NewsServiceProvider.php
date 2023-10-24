<?php

declare(strict_types=1);

namespace App\Modules\Api\News;

use App\Modules\Api\News\Contracts\NewsServiceContract;
use Illuminate\Support\ServiceProvider;

class NewsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(NewsServiceContract::class, NewsService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/routes/news.php');
    }
}
