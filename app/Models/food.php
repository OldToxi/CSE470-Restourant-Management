<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class food extends Model
{
    protected $hidden = [
        'title',
        'detail',
        'price',
        'image',
    ];

    public function ratings()
    {
        return $this->hasMany(Order::class, 'title', 'title')->whereNotNull('rating');
    }

}
