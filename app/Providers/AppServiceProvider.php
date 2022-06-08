<?php

namespace App\Providers;

use App\Domains\PropertyMatcher;
use App\Interfaces\Domains\PropertyMatcherInterface;
use App\Interfaces\Repositories\FieldRepositoryInterface;
use App\Interfaces\Repositories\PropertyRepositoryInterface;
use App\Interfaces\Repositories\SearchProfileRepositoryInterface;
use App\Interfaces\Services\MatchServiceInterface;
use App\Repositories\FieldRepository;
use App\Repositories\PropertyRepository;
use App\Repositories\SearchProfileRepository;
use App\Services\MatchService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MatchServiceInterface::class, MatchService::class);

        $this->app->bind(PropertyRepositoryInterface::class, PropertyRepository::class);
        $this->app->bind(SearchProfileRepositoryInterface::class, SearchProfileRepository::class);
        $this->app->bind(FieldRepositoryInterface::class, FieldRepository::class);

        $this->app->bind(PropertyMatcherInterface::class, PropertyMatcher::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
