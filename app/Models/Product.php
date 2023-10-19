<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_key',
        'soft_delete',
        'name',
        'image',
        'note',
        'price',
        'category_id',
        'session_id'
    ];
}
