@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>User Info</h1>
        <div class="card mb-4">



            <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-center gap-4">
                    {{-- @dd(asset('storage/images/' . $user->image)) --}}

                    <img src="{{ $user->image ? secure_asset($user->image) : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png' }}"
                        alt="user-avatar" width="200px" height="350px" class="d-block w-px-100 h-px-100 rounded" />

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


            </div>


            <!-- /Account -->
        </div>


    </div>
@endsection
