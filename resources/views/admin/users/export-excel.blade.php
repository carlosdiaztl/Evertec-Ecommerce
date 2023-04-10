<div class="container">


    <div class="card">
        <div class="card-header">

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
                                {{-- <th scope="col">Actions</th> --}}
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
                                    {{-- <td><a class="nav-link" href="{{ route('admin.users.show', $user) }}">Show</a>
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

                                        </td> --}}
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    <div class="col-11">
                        {{-- @dump(DB::getQueryLog()) --}}


                        {{-- {{ $users->links('pagination::bootstrap-5') }} --}}
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
