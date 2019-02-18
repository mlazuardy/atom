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

    public function getUserOrders($search)
    {
        return $this->model->search($search)->where('user_id',auth()->id())->orderBy('created_at','desc');
    }

    public function getUnpaidOrder()
    {
        return $this->model->where('status','unpaid');
    }
}