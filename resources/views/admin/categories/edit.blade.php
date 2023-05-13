@extends('layouts.app')
@section('content')
    <div class="container mt-3">

        <div class="card mb-4">
            <h5 class="card-header">Edit category</h5>
            <form class="card-body" method="POST" action="{{ route('admin.categories.update', $category) }}">
                @method('PUT')
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" for="multicol-username">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Write a name"
                            value="{{ old('name') ?? $category->name }}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="multicol-username">Description</label>
                        <input type="text" class="form-control" name="description" placeholder="description"
                            value="{{ old('description') ?? $category->description }}" />
                    </div>
                    <div class="col-12">
                        <button type="reset" class="btn btn-secondary">
                            Reset
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Edit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
