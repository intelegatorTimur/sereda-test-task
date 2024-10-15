<?php
namespace App\Interfaces;

use App\Models\Subscription;

interface SubscriptionInterface
{
    public function updateSubscription(Subscription $subscription, array $data): Subscription;

    public function calculateSubcriptionPrice(string $plan, int $usersCount, string $subscriptionCycle): float;
}
