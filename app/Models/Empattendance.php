<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empattendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_key',
        'soft_delete',
        'date',
        'time',
        'month',
        'year',
        'dateno',
        'employee_id',
        'attendance',
        'shift'
    ];
}
