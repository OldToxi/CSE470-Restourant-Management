<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $hidden = [
        'name',
        'email',
        'address',
        'title',
        'price',
        'quantity',
        'image',
        'delivery_status',
    ];
}
