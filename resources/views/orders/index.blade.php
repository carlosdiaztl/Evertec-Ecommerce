@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card border-0">
            <div class="card-header border-0">
                <h3>
                    Tus ordenes
                </h3>
            </div>
        </div>
        <div class="row justify-content-center mt-2">
            @if (count($user->orders))
                @foreach ($user->orders as $order)
                    <form class="card text-black m-1 col-sm-5" method="POST"
                        action="{{ route('payment.placetopay', $order) }}">
                        @csrf
                        <div
                            class="card-header bg-{{ $order->status === 'unconfirmed' ? 'danger' : ($order->status === 'confirmed' ? 'success' : 'warning') }}">
                            Orden {{ $order->status }}</div>
                        <div class="card-body">
                            <h5 class="card-title">Productos comprados </h5>
                            <ul>
                                @foreach ($order->products as $product)
                                    <li> {{ $product->title }}</li>
                                @endforeach
                            </ul>
                            <p class="card-text"> total {{ $order->total }}</p>
                        </div>
                        @if ($order->status === 'unconfirmed')
                            <div class="card-footer border-0 bg-white text-center">
                                <button class="btn btn-primary" type="submit">Pagar</button>
                            </div>
                        @endif
                        @if ($order->status === 'pending')
                        <div class="card-footer border-0 bg-white text-center">
                            <button class="btn btn-primary" type="submit">Re intentar pago</button>
                        </div>
                    @endif
                    </form>
                @endforeach
            @endif
        </div>
    </div>
@endsection
