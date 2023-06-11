@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card mb-4">
            <h5 class="card-header">Profile Details</h5>
            <!-- Account -->

            <form method="POST" action="{{ route('user.update', $user) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        {{-- @dd(asset('storage/images/' . $user->image)) --}}
                        <img src="{{ $user->image ? asset($user->image) : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png' }}"
                            alt="user-avatar" width="200px" height="350px" class="d-block w-px-100 h-px-100 rounded" style="object-fit: cover;" />
                        <div class="button-wrapper">
                            <label for="upload" class="btn btn-secondary me-2 mb-3" tabindex="0">
                                <span class="d-none d-sm-block">Upload new photo</span>
                                <i class="ti ti-upload d-block d-sm-none"></i>
                                <input type="file" id="upload" name="image" class="account-file-input"
                                    value="{{ old('image') }}" required autocomplete="image" autofocus hidden
                                    accept="image/png, image/jpeg" />

                            </label>
                            <button type="submit" class="btn btn-primary account-image-reset mb-3">
                                <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Confirm</span>
                            </button>



                            <div class="text-muted d-flex flex-column">

                                Allowed JPG,
                                GIF or PNG. Max size of 800K
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <hr class="my-0" />
            <div class="card-body">
                <form method="POST" action="{{ route('user.update', $user) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">First Name</label>
                            <input class="form-control" type="text" name="name"
                                value="{{ old('name') ?? $user->name }}" autofocus />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input class="form-control" type="text" name="lastName"
                                value="{{ old('lastName') ?? $user->lastName }}" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input class="form-control" type="email" name="email"
                                value="{{ old('email') ?? $user->email }}" placeholder="john.doe@example.com" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="identification" class="form-label">Identification</label>
                            <input type="text" class="form-control" name="identification"
                                value="{{ old('identification') ?? $user->identification }}" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="phone">Phone Number</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">Col(+57)</span>
                                <input type="text" name="phone" class="form-control" placeholder=""
                                    value="{{ old('phone') ?? $user->phone }}" />
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" placeholder="Address"
                                value="{{ old('address') ?? $user->address }}" />
                        </div>

                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                        {{-- <button type="reset" class="btn btn-label-secondary">Cancel</button> --}}
                    </div>
                </form>
            </div>



            <!-- /Account -->
        </div>
        <div class="card mb-4 mt-2">
            <h5 class="card-header">Change Password</h5>
            <div class="card-body">
                <form method="POST" action="{{ route('user.update', $user) }}">
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
