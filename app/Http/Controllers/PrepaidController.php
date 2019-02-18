<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Prepaid;
use App\Order;

class PrepaidController extends Controller
{
    public function create()
    {
        return view('prepaids.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mobile_number' => 'required|digits_between:7,12|starts_with:081',
            'value' => 'required',
        ]);
        DB::transaction(function() use($validated,$request) {
            $prepaid = new Prepaid();
            $prepaid->fill($validated);
            $prepaid->save();

            $order = new Order();
            $order->order_number = rand(1111111111, 9999999999);
            $order->total = $request->value + (10 * 100);
            $order->date = date(now());
            $order->status = 'unpaid';
            $order->user_id = auth()->id();
            $prepaid->order()->save($order);

        });
        return back();
    }
}
