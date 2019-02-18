<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Illuminate\Validation\Rule;
use App\Repository\OrderRepository;

class OrderController extends Controller
{

    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        $orders = $this->orderRepository->getUserOrders()->paginate(20);
        return view('orders.index',compact('orders'));
    }

    public function success($no)
    {
        $order = Order::where('order_number',$no)->firstOrFail();
        return view('orders.success',compact('order'));
    }

    public function payment()
    {
        return view('orders.payment');
    }

    public function prepaidPayment(Request $request)
    {
        $this->validate(request(),[
            'order_number' => [
                'required',
                Rule::exists('orders')->where(function($query){
                    $query->where('status','unpaid');
                }),
            ]
        ]);
        
        $order = Order::where('order_number',$request->order_number)->firstOrFail();
        $order->status = 'success';
        $order->save();
        return redirect('/home');
    }
}
