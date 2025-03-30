<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


use Application\Contracts\Services\AccountServiceContract;
use Application\Services\AccountService;

use Application\Contracts\Services\CounteragentServiceContract;
use Application\Services\CounteragentService;

use Application\Contracts\Repositories\UsersRepositoryContract;
use Infrastructure\Repositories\UsersRepository;

use Application\Contracts\Repositories\CounteragentRepositoryContract;
use Infrastructure\Repositories\CounteragentRepository;

use Laravel\Sanctum\Sanctum;
use  App\Sanctum\PersonalAccessToken;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Регистрируем сервисы
        $this->app->bind( AccountServiceContract::class, AccountService::class);
        $this->app->bind( CounteragentServiceContract::class, CounteragentService::class);

        // Регистрируем репозиторий
        $this->app->bind( UsersRepositoryContract::class, UsersRepository::class);
        $this->app->bind( CounteragentRepositoryContract::class, CounteragentRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
        //
    }
}
