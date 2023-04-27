@extends('layouts.app')
@section('content')
    Create New Products
    2 select categoria - status
    2 input text type - titulo - description
    2 input number
    input file img


    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
        @method('POST')
        @csrf



        <div class="col-6">
            <div class="card mb-4">
                <h5 class="card-header">Basic</h5>
                <div class="card-body">

                    <div class="dz-message needsclick">
                        Drop files here or click to upload

                    </div>
                    <input type="file" name="image" accept="image/png, image/jpeg" class="account-file-input">

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <h5 class="card-header">Default</h5>
                <div class="card-body">
                    <div>
                        <label for="defaultFormControlInput" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Write a title" />
                        <div class="form-text">
                            We'll never share your details with anyone else.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <div>
                        <label for="defaultFormControlInput" class="form-label">Description</label>
                        <input type="text" class="form-control" name="description" id="defaultFormControlInput"
                            placeholder="description" aria-describedby="defaultFormControlHelp" />
                        <div id="defaultFormControlHelp" class="form-text">
                            We'll never share your details with anyone else.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <div>
                        <label for="defaultFormControlInput" class="form-label">Stock</label>
                        <input type="number" name="stock" class="form-control" id="defaultFormControlInput"
                            placeholder="John Doe" aria-describedby="defaultFormControlHelp" />
                        <div id="defaultFormControlHelp" class="form-text">
                            We'll never share your details with anyone else.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <div>
                        <label for="defaultFormControlInput" class="form-label">Price</label>
                        <input type="number" name="price" class="form-control" id="defaultFormControlInput"
                            placeholder="John Doe" aria-describedby="defaultFormControlHelp" />
                        <div id="defaultFormControlHelp" class="form-text">
                            We'll never share your details with anyone else.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <label for="select2Basic" class="form-label">Status</label>
            <select id="select2Basic" name="status" class="select2 form-select form-select-lg" data-allow-clear="true">
                <option value="available">available</option>
                <option value="unavailable">unavailable</option>

            </select>
        </div>
        <div class="col-md-6 mb-4">
            <label for="select2Basic" class="form-label">Category</label>
            <select id="select2Basic" name="category_id" class="select2 form-select form-select-lg" data-allow-clear="true">
                <option value="1">Alaska</option>
                <option value="2">Hawaii</option>

            </select>
        </div>
        <div class="col-12">
            <button type="reset" class="btn btn-secondary">
                Reset
            </button>
            <button type="submit" class="btn btn-success">
                Crear
            </button>

        </div>
    </form>
@endsection
