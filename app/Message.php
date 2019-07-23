<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['content', 'from_id', 'to_id'];

    protected $table = 'messages';

    public function from()
    {
        return $this->belongsTo('App\User', 'from_id', 'id');
    }

    public function to()
    {
        return $this->belongsTo('App\User', 'to_id', 'id');
    }
}
