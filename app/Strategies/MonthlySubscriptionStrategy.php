<?php

namespace App\Strategies;

use App\Interfaces\SubscriptionStrategyInterface;

class MonthlySubscriptionStrategy implements SubscriptionStrategyInterface
{
    public function calculate(int $usersCount, float $price): float
    {
        return $usersCount * $price;
    }
}
