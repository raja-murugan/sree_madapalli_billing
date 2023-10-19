<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Determinationdata extends Model
{
    use HasFactory;

    protected $fillable = [
        'determination_id',
        'rupee',
        'count',
        'amount',
    ];
}
