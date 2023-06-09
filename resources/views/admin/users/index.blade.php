@extends('layouts.app')
@section('content')
    {{-- @livewire('admin.users-index') --}}
    <div class="container">


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
                            <thead class="table-light">
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
                                        <td class="d-flex"><a class="nav-link"
                                                href="{{ route('admin.users.show', $user) }}"><i class="ti ti-eye"
                                                    style="font-size: 24px;"></i></a>
                                            <a class="nav-link" href="{{ route('admin.users.edit', $user) }}"><i
                                                    class="ti ti-pencil" style="font-size: 24px;"></i></a>


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


                                <div class="demo-inline-spacing">
                                    <div class="btn-group" id="hover-dropdown-demo">
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                            data-bs-toggle="dropdown" data-trigger="hover">
                                            Export
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li> <a class="dropdown-item" href="{{ route('admin.users-pdf-export') }}">Pdf
                                                </a></li>
                                            <li> <a class="dropdown-item" href="{{ route('admin.users-excel-export') }}">
                                                    Excel</a></li>
                                        </ul>
                                    </div>
                                </div>


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
