<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Closeaccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_key',
        'soft_delete',
        'date',
        'opening_balance',
        'sales',
        'qrcode',
        'card',
        'cash_in_hand',
        'expense',
        'close_amount'
    ];
}
