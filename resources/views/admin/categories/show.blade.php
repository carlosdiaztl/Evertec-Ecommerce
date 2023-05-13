@extends('layouts.app')
@section('content')
    <div class="container mt-3">

        <div class="card mb-4">
            <h5 class="card-header">Edit category</h5>

            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label" for="multicol-username">Name</label>
                    <input type="text" readonly class="form-control" value="{{ $category->name }}" />
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="multicol-username">Description</label>
                    <input type="text" readonly class="form-control" value="{{ $category->description }}" />
                </div>

            </div>

        </div>
    </div>
@endsection
