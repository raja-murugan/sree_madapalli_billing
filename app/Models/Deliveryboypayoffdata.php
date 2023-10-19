<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliveryboypayoffdata extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_key',
        'soft_delete',
        'deliveryboy_id',
        'date',
        'month',
        'year',
        'payable_amount',
        'payoffnotes'
    ];
}
