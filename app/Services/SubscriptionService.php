<?php

namespace App\Services;

use App\Interfaces\SubscriptionFactoryInterface;
use App\Interfaces\SubscriptionInterface;
use App\Models\Subscription;
use Carbon\Carbon;

class SubscriptionService implements SubscriptionInterface
{
    private array $plans =  [
        'Lite' => 4,
        'Starter' => 6,
        'Premium' => 10
    ];
    private SubscriptionFactoryInterface $subscriptionStrategyFactory;

    public function __construct(SubscriptionFactoryInterface $subscriptionStrategyFactory)
    {
        $this->subscriptionStrategyFactory = $subscriptionStrategyFactory;
    }

    public function calculateSubcriptionPrice(string $plan, int $usersCount, string $subscriptionCycle): float
    {
        $basePrice = $this->plans[$plan];
        $pricingStrategy = $this->subscriptionStrategyFactory->createSubscriptionStrategy($subscriptionCycle);
        return $pricingStrategy->calculate($usersCount, $basePrice);
    }

    public function updateSubscription(Subscription $subscription, array $data): Subscription
    {
        $newPlan = $data['plan'];
        $usersCount = $data['users_count'];
        $subscriptionCycle = $data['billing_cycle'];

        $totalPrice = $this->calculateSubcriptionPrice($newPlan, $usersCount, $subscriptionCycle);

        $subscription->fill([
            'plan'              => $newPlan,
            'users_count'       => $usersCount,
            'total_price'       => $totalPrice,
            'billing_cycle'     => $subscriptionCycle,
            'next_billing_date' => $this->calculateNextBillingDate($subscription->next_billing_date, $subscriptionCycle),
        ]);

        $subscription->save();

        return $subscription->fresh();
    }


    private function calculateNextBillingDate(Carbon $currentSubscriptionDate, string $subscriptionCycle): Carbon
    {
        return $subscriptionCycle === 'yearly'
            ? $currentSubscriptionDate->addYear()
            : $currentSubscriptionDate->addMonth();
    }
}
