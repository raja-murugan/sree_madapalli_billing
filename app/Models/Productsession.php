<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productsession extends Model
{
    use HasFactory;

    protected $fillable = [
        'soft_delete',
        'product_id',
        'session_id',
        'sessionname',
        'category_id',
        'category_name',
        'productname',
        'productimage',
        'productprice'
    ];
}
