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

    public function getPriceAttribute($value)
    {
        return number_format($value, 0, ',', '.');
    }

    /**
     * Mutator
     * All Product Name will be Capitalize
     */
    public function setProductAttribute($value)
    {
        $this->attributes['product'] = title_case($value);
    }

}
