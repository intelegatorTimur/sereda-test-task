@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Current Subscription</h5>
                <p>Plan: {{ $subscription->plan }}</p>
                <p>Total Price: {{ number_format($subscription->total_price, 2) }}</p>
                <p>Billing Subscription: {{ ucfirst($subscription->billing_cycle) }}</p>
                <p>Next subscription Date: {{ $subscription->next_billing_date->format('d.m.Y') }}</p>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Update Subscription</h5>
                <form action="{{ route('subscription.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="plan">Plan</label>
                        <select name="plan" id="plan" class="form-control">
                            <option value="Lite" {{ $subscription->plan == 'Lite' ? 'selected' : '' }}>Lite (4/user/month)</option>
                            <option value="Starter" {{ $subscription->plan == 'Starter' ? 'selected' : '' }}>Starter (6/user/month)</option>
                            <option value="Premium" {{ $subscription->plan == 'Premium' ? 'selected' : '' }}>Premium (10/user/month)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="billing_cycle">Billing Cycle</label>
                        <select name="billing_cycle" id="billing_cycle" class="form-control">
                            <option value="monthly" {{ $subscription->billing_cycle == 'monthly' ? 'selected' : '' }}>Monthly</option>
                            <option value="yearly" {{ $subscription->billing_cycle == 'yearly' ? 'selected' : '' }}>Yearly (20% discount)</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Subscription</button>
                </form>
            </div>
        </div>
    </div>
@endsection
