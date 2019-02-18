<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Order;

class ProductController extends Controller
{
    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product' => 'required|min:10|max:150',
            'address' => 'required|min:10|max:150',
            'price' => 'required|numeric'
        ]);

        DB::beginTransaction();
        $product = new Product();
        $product->fill($validated);
        $product->save();

        $order = new Order();
        $order->order_number = rand(1111111111, 9999999999);
        $order->total = $request->price + 10000;
        $order->date = date(now());
        $order->status = 'unpaid';
        $order->user_id = auth()->id();
        $product->order()->save($order);
        if (!$order || !$product) {
            DB::rollBack();
        } else {
            DB::commit();
        }
        return redirect()->route('order.success', $order->order_number);
    }
}
