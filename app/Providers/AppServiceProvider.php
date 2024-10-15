<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\SubscriptionService;
use App\Interfaces\SubscriptionInterface;
use App\Interfaces\SubscriptionFactoryInterface;
use App\Factories\SubscriptionStrategyFactory;
use App\Interfaces\SubscriptionStrategyInterface;
use App\Strategies\YearlySubscriptionStrategy;
use App\Strategies\MonthlySubscriptionStrategy;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SubscriptionStrategyInterface::class, MonthlySubscriptionStrategy::class);
        $this->app->bind(SubscriptionStrategyInterface::class, YearlySubscriptionStrategy::class);
        $this->app->bind(SubscriptionFactoryInterface::class, SubscriptionStrategyFactory::class);
        $this->app->bind(SubscriptionInterface::class, SubscriptionService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
