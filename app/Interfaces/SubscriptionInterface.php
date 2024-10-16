<?php
namespace App\Interfaces;

use App\Models\Subscription;

interface SubscriptionInterface
{
    /**
     * @param Subscription $subscription
     * @param array $data
     * @return Subscription
     */
    public function updateSubscription(Subscription $subscription, array $data): Subscription;

    /**
     * @param string $plan
     * @param int $usersCount
     * @param string $subscriptionCycle
     * @return float
     */
    public function calculateSubcriptionPrice(string $plan, int $usersCount, string $subscriptionCycle): float;

    /**
     * @return Subscription
     */
    public function getSubscription(): Subscription;
}
