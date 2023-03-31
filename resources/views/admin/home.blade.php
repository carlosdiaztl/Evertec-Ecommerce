@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Panel Admin <br>
                        <h4> Bienvenido, Que deseas hacer el dia de hoy ? </h4>
                        {{-- {{ auth()->user()->hasRole('Admin')? 'si': 'no' }} --}}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <ul class="navbar-nav mr-auto">


                            <li class="nav-item">
                                <a class="btn btn-primary btn-md" href="{{ route('admin.users.index') }}">Administrar
                                    usuarios</a>
                            </li>
                            <li class="nav-item mt-2">
                                <a class="btn btn-primary btn-md" href="#">Link</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
