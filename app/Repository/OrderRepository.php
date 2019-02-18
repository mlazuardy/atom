<?php

namespace App\Repository;

use App\Order;

class OrderRepository
{
    protected $model;

    public function __construct(Order $order)
    {
        $this->model = $order;
    }

    public function getUserOrders()
    {
        return $this->model->where('user_id',auth()->id())->orderBy('created_at','desc');
    }
}