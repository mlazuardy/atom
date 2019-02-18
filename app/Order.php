<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = ['order_number'];

    public function orderable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
