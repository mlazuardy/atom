@extends('layouts.app')
@section('title','Order History')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Order History</h4>
                        <form action="">
                            <input type="search" name="search" placeholder="Search By Order Number" value="{{old('search',request('search'))}}" class="form-control" id="">
                        </form>
                    </div>
                    <div class="card-body p-0">
                        <table class="table mb-0">
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>
                                            <h5>{{$order->order_number}} - <b>Rp {{$order->total}}</b></h5>
                                            <p class="mb-0">
                                                @if($order->orderable_type == "App\Prepaid")
                                                    Rp {{$order->orderable->value}} for {{$order->orderable->mobile_number}}
                                                @else
                                                    {{$order->orderable->product}} that costs Rp {{$order->orderable->price}}
                                                @endif
                                            </p>
                                        </td>
                                        <td class="text-right">
                                            @switch($order->status)
                                                @case('unpaid')
                                                    <a href="/payment?order_number={{$order->order_number}}" class="btn btn-primary">PAY NOW</a>
                                                    @break
                                                @case('success')
                                                    @if($order->orderable_type =="App\Product")
                                                        <p>
                                                            Shipping Code
                                                            <br/>
                                                            {{$order->orderable->shipping_code}}
                                                        </p>
                                                    @else
                                                        <p class="text-info">Success</p>    
                                                    @endif
                                                    @break
                                                @case('failed')
                                                    <p class="text-warning">Failed</p>
                                                    @break
                                                @case('canceled')
                                                    <p class="text-danger">Canceled</p>
                                                    @break
                                                @default
                                                    <p>
                                                        Invalid Status
                                                    </p>
                                            @endswitch
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{$orders->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection