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
                        <form action="" method="POST">
                            @csrf
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection