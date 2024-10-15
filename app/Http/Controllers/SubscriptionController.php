<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSubscriptionRequest;
use App\Interfaces\SubscriptionInterface;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;


class SubscriptionController extends Controller
{
    private SubscriptionInterface $subscriptionService;

    public function __construct(SubscriptionInterface $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    public function show(): View
    {
        $subscription = Subscription::first();

        return view('subscription.show', compact('subscription'));
    }

    public function update(UpdateSubscriptionRequest $request): RedirectResponse
    {
        $subscription = Subscription::first();
        $updatedSubscription = $this->subscriptionService->updateSubscription($subscription, $request->validated());

        if ($updatedSubscription) {
            return redirect()->route('subscription.show')
                ->with('success', 'Subscription updated successfully.');
        } else {
            return redirect()->route('subscription.show')
                ->with('error', 'Failed to update subscription.');
        }
    }
}
