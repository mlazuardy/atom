@extends('layouts.app')
@section('title','Payment')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>Pay your order</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{route('payment.store')}}" method="POST">
                            @csrf
                           <div class="form-group">
                               <input type="text" name="order_number" placeholder="Order Number" value="{{old('order_number', request('order_number') )}}"
                                    class="form-control"> {!! ifError($errors,'order_number') !!}
                           </div>
                           <button type="submit" class="btn btn-primary btn-block">PAY NOW</button>
                        </form>   
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection