<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;


    protected $fillable = [
        'unique_key',
        'soft_delete',
        'bill_no',
        'voucher_no',
        'date',
        'time',
        'supplier_id',
        'sub_total',
        'tax',
        'total',
        'tax_amount',
        'discount_price',
        'discount_type',
        'discount',
        'grandtotal',
        'paidamount',
        'balanceamount',
        'payment_method'
    ];
}
