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

    /**
     * Accessor to get Rupiah
     * so we dont need to render rupiah with number_format when needed
     */
    public function getTotalAttribute($value)
    {
        return number_format($value, 0, ',', '.');
    }

    public function scopeSearch($query,$search)
    {
        return $query->where('order_number','like',"%$search%");
    }
}
