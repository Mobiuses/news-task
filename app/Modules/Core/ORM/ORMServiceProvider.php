<?php

declare(strict_types=1);

namespace App\Modules\Core\ORM;

use App\Modules\Core\ORM\Managers\Contracts\NewsManagerContract;
use App\Modules\Core\ORM\Managers\NewsManager;
use App\Modules\Core\ORM\Repositories\Contracts\NewsRepositoryContract;
use App\Modules\Core\ORM\Repositories\NewsRepository;
use Illuminate\Support\ServiceProvider;

class ORMServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->bindRepositories();
        $this->bindManagers();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    /**
     * @return void
     */
    private function bindRepositories(): void
    {
        $this->app->singleton(NewsRepositoryContract::class, NewsRepository::class);

    }

    /**
     * @return void
     */
    private function bindManagers(): void
    {
        $this->app->singleton(NewsManagerContract::class, NewsManager::class);
    }
}
