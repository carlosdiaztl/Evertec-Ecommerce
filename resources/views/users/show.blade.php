@extends('layouts.app')
@section('content')
    <div class="container">


        <div class="card text-center">
            {{-- @dd($user) --}}
            <div class="card-header">
                {{ $user->name }}
            </div>
            <div class="card-body">
                <p class="card-text">
                    Email:
                    {{ $user->email }}
                </p>
                <p class="card-text">
                    current satus:
                    {{ $user->status }}
                </p>

            </div>
            <div class="card-footer">
                <form method="POST" action="{{ route('users.update', $user) }}">
                    @csrf
                    @method('PUT')
                    <div>

                        <input type="text" class="d-none" name="status"
                            value="{{ $user->status == 'active' ? 'inactive' : 'active' }}" placeholder="" readonly>
                    </div>


                    <button type="submit"
                        class="btn btn-{{ $user->status == 'active' ? 'danger' : 'success' }}">{{ $user->status == 'active' ? 'Inactivar' : 'Activar' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
