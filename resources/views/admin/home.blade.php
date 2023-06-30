@extends('layouts.app')
@section('content')
    <div class="container d-flex flex-column ">
        <div class="card text-center">
            <div class="card-body ">
                <h2>
                    Bienvenido que deseas hacer ?
                </h2>
                <a href="{{route('admin.users.index')}}" class="btn btn-primary mt-2 col-6">Ver usuarios </a>
                <a href="{{route('admin.products.index')}}" class="btn btn-primary mt-2 col-6">Ver productos </a>
            </div>
        </div>
    </div>
    <div id="app">
        {{-- <product-component products="{{ json_encode($products) }}"></product-component> --}}
{{-- <products-component></products-component> --}}
        
    </div>
@endsection
