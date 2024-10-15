<?php
namespace App\Factories;

use App\Interfaces\SubscriptionFactoryInterface;
use App\Strategies\MonthlySubscriptionStrategy;
use App\Strategies\YearlySubscriptionStrategy;

class SubscriptionStrategyFactory implements SubscriptionFactoryInterface
{
    /**
     * @param string $subscriptionCycle
     * @return MonthlySubscriptionStrategy|YearlySubscriptionStrategy
     */
    public function createSubscriptionStrategy(string $subscriptionCycle): MonthlySubscriptionStrategy|YearlySubscriptionStrategy
    {
        return match ($subscriptionCycle) {
            'yearly'  => new YearlySubscriptionStrategy(),
            'monthly' => new MonthlySubscriptionStrategy(),
        };
    }
}
