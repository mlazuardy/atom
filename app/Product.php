<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    /**
     * Product has One Order
     */
    public function order()
    {
        return $this->morphOne('App\Order','orderable');
    }
}