<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class OrderController extends Controller
{
    public function success($no)
    {
        $order = Order::where('order_number',$no)->firstOrFail();
        return view('orders.success',compact('order'));
    }

    public function payment()
    {
        return view('orders.payment');
    }
}
