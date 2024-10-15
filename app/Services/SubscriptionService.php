<?php

namespace App\Services;

use App\Interfaces\SubscriptionFactoryInterface;
use App\Interfaces\SubscriptionInterface;
use App\Models\Subscription;
use Carbon\Carbon;

class SubscriptionService implements SubscriptionInterface
{
    const PLANS =  [
        'Lite'    => 4,
        'Starter' => 6,
        'Premium' => 10
    ];

    private SubscriptionFactoryInterface $subscriptionStrategyFactory;

    /**
     * @param SubscriptionFactoryInterface $subscriptionStrategyFactory
     */
    public function __construct(SubscriptionFactoryInterface $subscriptionStrategyFactory)
    {
        $this->subscriptionStrategyFactory = $subscriptionStrategyFactory;
    }

    /**
     * @param string $plan
     * @param int $usersCount
     * @param string $subscriptionCycle
     * @return float
     */
    public function calculateSubcriptionPrice(string $plan, int $usersCount, string $subscriptionCycle): float
    {
        $basePrice = self::PLANS[$plan];
        $pricingStrategy = $this->subscriptionStrategyFactory->createSubscriptionStrategy($subscriptionCycle);
        return $pricingStrategy->calculate($usersCount, $basePrice);
    }

    /**
     * @param Subscription $subscription
     * @param array $data
     * @return Subscription
     */
    public function updateSubscription(Subscription $subscription, array $data): Subscription
    {
        $newPlan = $data['plan'];
        $subscriptionCycle = $data['billing_cycle'];

        $totalPrice = $this->calculateSubcriptionPrice($newPlan, $subscription->users_count, $subscriptionCycle);

        $subscription->fill([
            'plan'              => $newPlan,
            'total_price'       => $totalPrice,
            'billing_cycle'     => $subscriptionCycle,
            'next_billing_date' => $this->calculateNextBillingDate($subscription->next_billing_date, $subscriptionCycle),
        ]);

        $subscription->save();

        return $subscription->fresh();
    }

    /**
     * @param Carbon $currentSubscriptionDate
     * @param string $subscriptionCycle
     * @return Carbon
     */
    private function calculateNextBillingDate(Carbon $currentSubscriptionDate, string $subscriptionCycle): Carbon
    {
        return $subscriptionCycle === 'yearly'
            ? $currentSubscriptionDate->addYear()
            : $currentSubscriptionDate->addMonth();
    }
}
