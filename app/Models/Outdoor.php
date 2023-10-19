<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outdoor extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_key',
        'soft_delete',
        'bill_no',
        'booking_date',
        'delivery_date',
        'delivery_time',
        'name',
        'address',
        'phone_number',
        'note',
        'sub_total',
        'outdoortax',
        'outdoortax_amount',
        'total',
        'payment_term',
        'payment_amount',
        'balanceamount',
        'bank_id',
        'payment_date',
        'delivery_status'
    ];
}
