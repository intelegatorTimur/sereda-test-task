<?php

namespace Database\Seeders;

use App\Models\Subscription;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Subscription::create([
            'plan' => 'Lite',
            'users_count' => 7,
            'total_price' => 28.00,
            'billing_cycle' => 'monthly',
            'next_billing_date' => now()->addMonth(),
        ]);

    }

}
