<?php

namespace App\Interfaces;

interface SubscriptionStrategyInterface
{
    public function calculate(int $usersCount, float $price): float;
}
