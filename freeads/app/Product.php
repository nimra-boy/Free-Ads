<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'user_id', 'title', 'description', 'price', 'type'
    ];

    protected $table = 'products';

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
