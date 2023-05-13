@extends('layouts.app')
@section('content')
    <div class="container mt-3">

        <div class="card mb-4">
            <h5 class="card-header">Create new product</h5>
            <form class="card-body" method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label" for="multicol-username">Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Write a title"
                            value="{{ old('title') }}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="multicol-username">Description</label>
                        <input type="text" class="form-control" name="description" placeholder="description"
                            value="{{ old('description') }}" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="multicol-username">Stock</label>
                        <input type="number" name="stock" class="form-control" placeholder="Stock"
                            value="{{ old('stock') }}" />
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="multicol-username">Price</label>
                        <input type="number" name="price" class="form-control" placeholder="253300"
                            value="{{ old('price') }}" />
                    </div>
                    <div class="col-md-6 select2-primary">
                        <label class="form-label" for="multicol-language">Status</label>
                        <select id="select2Basic" name="status" class="select2 form-select form-select-lg"
                            data-allow-clear="true">
                            @empty($statuses)

                                <option value="">No hay estados disponibles</option>
                            @else
                                @foreach ($statuses as $status)
                                    <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>
                                        {{ $status }}</option>
                                @endforeach

                                @endif

                            </select>
                        </div>


                        @if ($categories->count())

                            <div class="col-md-6 select2-primary ">
                                <label for="select2Basic" class="form-label">Category</label>
                                <select id="select2Basic" name="category_id" class="select2 form-select form-select-lg"
                                    data-allow-clear="true">

                                    @foreach ($categories as $category)
                                        <option value={{ $category->id }}
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        @else
                            <div class="col-md-6 select2-primary ">
                                <label for="select2Basic" class="form-label">Category</label>


                                <div class="card-body shadow-none p-3 mb-5 bg-light rounded">No hay categorias


                                    <a href="{{ route('admin.home') }}" class="btn btn-primary btn-sm">Crea una categoria</a>
                                </div>


                            </div>
                        @endif


                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="multicol-username">IMG</label>
                        <input type="file" value="{{ old('image') }}" name="image" accept="image/png, image/jpeg"
                            class="form-control">
                    </div>

                    <div class="col-12">
                        <button type="reset" class="btn btn-secondary">
                            Reset
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Create
                        </button>

                    </div>
            </div>
            </form>
        </div>
        </div>
    @endsection
