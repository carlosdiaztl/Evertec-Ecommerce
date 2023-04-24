@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>User Info</h1>
        <div class="card mb-4">



            <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-center gap-4">
                    {{-- @dd(asset('storage/images/' . $user->image)) --}}
                    <img src="{{ asset($user->image) }}" alt="user-avatar" width="200px" height="350px"
                        class="d-block w-px-100 h-px-100 rounded" />

                </div>
            </div>


            <!-- Account -->

            <div class="card-body">

            </div>
            <hr class="my-0" />
            <div class="card-body">

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="firstName" class="form-label">First Name</label>
                        <input readonly class="form-control" type="text" name="firstName" value="{{ $user->name }}"
                            autofocus />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input readonly class="form-control" type="text" name="lastName" value="{{ $user->lastName }}" />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">E-mail</label>
                        <input readonly class="form-control" type="text" name="email" value="{{ $user->email }}"
                            placeholder="{{ $user->email }}" />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="identification" class="form-label">Identification</label>
                        <input readonly type="text" class="form-control" name="identification"
                            value="{{ $user->identification }}" />
                    </div>
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="phoneNumber">Phone Number</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text">Col(+57) </span>
                            <input readonly type="text" name="phoneNumber" class="form-control"
                                value="{{ $user->phone }}" />
                        </div>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="address" class="form-label">Address</label>
                        <input readonly type="text" class="form-control" name="address" value="{{ $user->address }}" />
                    </div>

                </div>
                {{-- <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">Save changes</button>
                    <button type="reset" class="btn btn-label-secondary">Cancel</button>
                </div> --}}

            </div>


            <!-- /Account -->
        </div>
        <div class="card">
            <h5 class="card-header"> {{ $user->status == 'active' ? 'Inactive' : 'Active' }} Account</h5>
            <div class="card-body">
                <div class="mb-3 col-12 mb-0">
                    <div class="alert alert-warning">
                        <h5 class="alert-heading mb-1">Are you sure you want to
                            {{ $user->status == 'active' ? 'inactive' : 'active' }} your account?</h5>
                        {{-- <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p> --}}
                    </div>
                </div>
                <form method="POST" action="{{ route('admin.users.update', $user) }}">
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
        <div class="card mb-4 mt-2">
            <h5 class="card-header">Change Password</h5>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.users.update', $user) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="mb-3 col-md-6 form-password-toggle">
                            <label class="form-label" for="Password">New Password</label>
                            <div class="input-group input-group-merge">
                                <input class="form-control" type="password" name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                        </div>
                        <div class="mb-3 col-md-6 form-password-toggle">
                            <label class="form-label" for="confirmPassword">Confirm New Password</label>
                            <div class="input-group input-group-merge">
                                <input class="form-control" type="password" name="password_confirmation"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-4">
                        <h6>Password Requirements:</h6>
                        <ul class="ps-3 mb-0">
                            <li class="mb-1">Minimum 8 characters long - the more, the better</li>
                            <li class="mb-1">At least one lowercase character</li>
                            <li>At least one number, symbol, or whitespace character</li>
                        </ul>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
