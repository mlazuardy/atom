<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Illuminate\Validation\Rule;
use App\Repository\OrderRepository;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        $search = request()->only('search');
        $orders = $this->orderRepository->getUserOrders(request('search'))->paginate(20);
        $orders->appends(request()->only('search'));
        return view('orders.index',compact('orders'));
    }

    public function success($no)
    {
        $order = $this->orderRepository->getUnpaidOrder()->whereOrderNumber($no)->firstOrFail();
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
        
        DB::beginTransaction();
        $order = $this->orderRepository->getUnpaidOrder()->whereOrderNumber($request->order_number)->firstOrFail();
        $order->status = 'success';
        $order->save();
        if($order->orderable_type == "App\Product"){
            $order->orderable()->update(['shipping_code' => str_random(10)]);
        }
        if(!$order){
            DB::rollBack();
        } else {
            DB::commit();
        }
        return redirect('/home');
    }
}
