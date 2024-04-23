@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ secure_asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/product.css') }}">
@endsection
@section('content')
    <!--Main layout-->




    <div class="container">
        <div class="row">
            <!--Grid column-->
            <div class="col-md-6 mb-4">
                <img src={{ secure_asset($product->image) }} class="img-fluid" alt="" />
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-md-6 mb-4">
                <!--Content-->
                <div class="p-4">
                    <div class="mb-3">
                        <a href="">
                            <span class="badge bg-dark me-1">Category {{ $product->category_id }} </span>
                        </a>

                    </div>
                    <strong>
                        <p style="font-size: 20px;">Price</p>
                    </strong>

                    <p class="lead">

                        <span> {{ $product->price }}$ </span>
                    </p>
                    <strong>
                        <p style="font-size: 20px;">Stock</p>
                    </strong>
                    <p class="lead">

                        <span> {{ $product->stock }}$ </span>
                    </p>

                    <strong>
                        <p style="font-size: 20px;">Description</p>
                    </strong>

                    <p>{{ $product->description }} </p>


                </div>
                <!--Content-->
            </div>
            <!--Grid column-->
        </div>
        <!--Grid row-->

        <hr />




    </div>

    <!--Main layout-->
@endsection
