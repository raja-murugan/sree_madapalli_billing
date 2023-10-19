<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliveryboypayoff extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_key',
        'soft_delete',
        'date',
        'month',
        'year',
        'deliveryboy_id',
        'total_days',
        'present_shifts',
        'pershiftsalary',
        'total_salaryamount',
        'paid_salary',
        'amountgiven',
        'status'
    ];
}
