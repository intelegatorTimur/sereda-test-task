<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;
    protected $table = 'subscription';

    protected $fillable = [
        'plan',
        'users_count',
        'total_price',
        'billing_cycle',
        'next_billing_date',
    ];

    protected $casts = [
        'next_billing_date' => 'date',
    ];

}
