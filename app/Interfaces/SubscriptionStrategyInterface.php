<?php

namespace App\Interfaces;

interface SubscriptionStrategyInterface
{
    /**
     * @param int $usersCount
     * @param float $price
     * @return float
     */
    public function calculate(int $usersCount, float $price): float;
}
