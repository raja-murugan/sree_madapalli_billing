<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payoffdata extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_key',
        'soft_delete',
        'employee_id',
        'date',
        'month',
        'year',
        'salaryamount',
        'total_given',
        'payable_amount',
        'payoffnotes'
    ];
}
