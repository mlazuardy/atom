<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prepaid extends Model
{
    protected $guarded = [];

    /**
     * Prepaid Balance has One Order
     */
    public function order()
    {
        return $this->morphOne('App\Order','orderable');
    }
}
