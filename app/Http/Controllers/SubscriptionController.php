<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSubscriptionRequest;
use App\Interfaces\SubscriptionInterface;
use App\Models\Subscription;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class SubscriptionController extends Controller
{
    private SubscriptionInterface $subscriptionService;

    /**
     * @param SubscriptionInterface $subscriptionService
     */
    public function __construct(SubscriptionInterface $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    /**
     * @return View
     */
    public function show(): View
    {

        $subscription = $this->subscriptionService->getSubscription();
        return view('subscription.show', compact('subscription'));
    }

    /**
     * @param UpdateSubscriptionRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateSubscriptionRequest $request): RedirectResponse
    {
        $subscription = $this->subscriptionService->getSubscription();
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
