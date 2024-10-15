<?php

namespace App\Strategies;

use App\Interfaces\SubscriptionStrategyInterface;

class YearlySubscriptionStrategy implements SubscriptionStrategyInterface
{
    public function calculate(int $usersCount, float $price): float
    {
        return $usersCount * $price * 12 * 0.8;
    }
}
