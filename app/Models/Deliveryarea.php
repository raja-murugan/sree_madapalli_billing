<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliveryarea extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_key',
        'unique_key',
        'soft_delete',
        'name',
        'note'
    ];


    public function deliveryboy()
    {
        return $this->hasMany(Deliveryboy::class, 'delivery_area_id');
    }
}
