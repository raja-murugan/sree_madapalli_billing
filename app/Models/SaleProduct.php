<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'soft_delete',
        'sales_id',
        'product_id',
        'quantity',
        'price',
        'total_price',
        'product_session_id'
    ];
}
