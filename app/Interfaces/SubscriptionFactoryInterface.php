<?php

namespace App\Interfaces;

use App\Strategies\MonthlySubscriptionStrategy;
use App\Strategies\YearlySubscriptionStrategy;

interface SubscriptionFactoryInterface
{
    public function createSubscriptionStrategy(string $subscriptionCycle): MonthlySubscriptionStrategy|YearlySubscriptionStrategy;
}
