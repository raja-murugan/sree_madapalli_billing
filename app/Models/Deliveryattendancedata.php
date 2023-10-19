<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliveryattendancedata extends Model
{
    use HasFactory;

    protected $fillable = [
        'deliveryattendance_id',
        'deliveryboy_id',
        'attendance',
        'session_id',
        'sessionname',
        'deliveryboy',
        'date',
        'month',
        'year',
        'checkleave'
    ];
}
