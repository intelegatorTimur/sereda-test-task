<?php

namespace App\Interfaces;

use App\Strategies\MonthlySubscriptionStrategy;
use App\Strategies\YearlySubscriptionStrategy;

interface SubscriptionFactoryInterface
{
    /**
     * @param string $subscriptionCycle
     * @return MonthlySubscriptionStrategy|YearlySubscriptionStrategy
     */
    public function createSubscriptionStrategy(string $subscriptionCycle): MonthlySubscriptionStrategy|YearlySubscriptionStrategy;
}
