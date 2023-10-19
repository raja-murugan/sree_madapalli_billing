<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outdoorpayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'outdoor_id',
        'payment_term',
        'payment_amount',
        'payment_date',
        'payment_method'
    ];
}
