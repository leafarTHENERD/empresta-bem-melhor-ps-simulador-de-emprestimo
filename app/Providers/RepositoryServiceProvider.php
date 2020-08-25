<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\InstitutionFeeRepository;
use App\Repository\InstitutionRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(InstitutionFeeRepository::class, InstitutionFeeRepository::class);
        $this->app->bind(InstitutionRepository::class, InstitutionRepository::class);
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
