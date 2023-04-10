@extends('layouts.app')
@section('content')
    {{-- @livewire('admin.users-index') --}}
    <div class="container">
        <a href="{{ route('admin.users-excel-export') }}">exportar en excel</a>

        <div class="card">
            <div class="card-header">
                <form class="form-inline my-2 my-lg-0 d-flex">


                    <input class="form-control mr-sm-2 mx-2 form-control-sm" type="search" name="search" placeholder="Search"
                        aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>

                </form>
            </div>

            @if ($users->count())
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Email verified</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <th scope="row">{{ $user->id }} </th>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->email_verified_at ? 'Verificado' : 'Sin verificar' }}</td>
                                        <td>{{ $user->status }}</td>
                                        <td><a class="nav-link" href="{{ route('admin.users.show', $user) }}">Show</a>
                                            <form method="POST" action="{{ route('admin.users.update', $user) }}">
                                                @csrf
                                                @method('PUT')
                                                <div>

                                                    <input type="text" class="d-none" name="status"
                                                        value="{{ $user->status == 'active' ? 'inactive' : 'active' }}"
                                                        placeholder="" readonly>
                                                </div>


                                                <button type="submit"
                                                    class="btn btn-{{ $user->status == 'active' ? 'danger' : 'success' }}">{{ $user->status == 'active' ? 'Inactivar' : 'Activar' }}
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                        <div class="row">
                            <div class="col-10">

                                {{ $users->links('pagination::bootstrap-5') }}
                            </div>
                            <div class="col-2">
                                <a href="{{ route('admin.users-pdf-export') }}" class="btn btn-primary">download pdf </a>
                            </div>
                            {{-- @dump(DB::getQueryLog()) --}}
                        </div>

                    </div>

                </div>
            @else
                <div class="card-body">
                    <strong>No hay registros</strong>
                </div>
            @endif
        </div>
    </div>

    {{-- <livewire:admin.users-index> --}}
@endsection
