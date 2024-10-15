<?php

namespace App\Strategies;

use App\Interfaces\SubscriptionStrategyInterface;

class MonthlySubscriptionStrategy implements SubscriptionStrategyInterface
{
    /**
     * @param int $usersCount
     * @param float $price
     * @return float
     */
    public function calculate(int $usersCount, float $price): float
    {
        return $usersCount * $price;
    }
}
