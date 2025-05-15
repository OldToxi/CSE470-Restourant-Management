<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class food extends Model
{
    protected $guarded = [];
    protected $hidden = [
        'title',
        'detail',
        'price',
        'image',
    ];

}
