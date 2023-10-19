<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payoff extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_key',
        'soft_delete',
        'date',
        'month',
        'year',
        'employee_id',
        'total_days',
        'present_days',
        'perdaysalary',
        'total_salaryamount',
        'paid_salary',
        'amountgiven',
        'status'
    ];
}
