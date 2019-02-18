@extends('layouts.app')
@section('title','Product')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Product Page</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('product.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <textarea name="product" cols="30" rows="3" placeholder="Product" class="form-control">{{old('product')}}</textarea>
                                {!! ifError($errors,'product') !!}
                            </div>                            
                            <div class="form-group">
                                <textarea placeholder="Shipping Address" name="address"  cols="30" rows="3" class="form-control">{{old('shipping_address')}}</textarea>
                                {!! ifError($errors,'address') !!}
                            </div>
                            <div class="form-group">
                                <input type="text" name="price" placeholder="Price" value="{{old('price')}}" id="" class="form-control">
                                {!! ifError($errors,'price') !!}
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection