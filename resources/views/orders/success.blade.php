@extends('layouts.app')
@section('title','success')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Success</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Order No</h3>
                            </div>
                            <div class="col-md-6 text-right">
                                <h3>{{$order->order_number}}</h3>
                            </div>
                            <div class="col-md-6">
                                <h3>Total</h3>
                            </div>
                            <div class="col-md-6 text-right">
                                <h3>Rp {{$order->total}}</h3>
                            </div>
                        </div>
                        @if($order->orderable_type == "App\Prepaid")
                        <p class="mt-3">
                            Your mobile phone number {{$order->orderable->mobile_number}} will receive Rp {{$order->total}}
                        </p>
                        @else
                        <p class="mt-3">
                            {{$order->orderable->product}} that costs Rp {{$order->orderable->price}} will be shipped to:
                            <br/>
                            {{$order->orderable->address}}
                            <br/>
                            only after you pay
                        </p>
                        @endif
                        <a href="{{url("/payment?order_number={$order->order_number}")}}" class="btn btn-primary btn-block">PAY NOW</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection