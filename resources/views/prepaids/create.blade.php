@extends('layouts.app')
@section('title','Prepaid Balance')
@section('content')
    <div class="container pt-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{route('prepaid.store')}}" method="post">
                @csrf
                    <div class="form-group">
                        <input type="text" name="mobile_number" placeholder="Mobile Number" value="{{old('mobile_number')}}" class="form-control">
                        {!! ifError($errors,'mobile_number') !!}
                    </div>
                    <div class="form-group">
                        <select name="value" class="form-control">
                            <option value="10000">10.000</option>
                            <option value="50000">50.000</option>
                            <option value="10000">100.000</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection