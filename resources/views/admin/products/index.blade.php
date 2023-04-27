@extends('layouts.app')
@section('content')
    <div class="container">
        <a class="btn btn-primary mb-2" href="{{ route('admin.products.create') }}">Create new product</a>
        <div class="card">
            <h5 class="card-header">Products</h5>
            <div class="table-responsive">
                <table class="table">
                    <thead class="bg-secondary">
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($products as $product)
                            <tr>
                                <td>
                                    {{ $product->title }}
                                </td>
                                <td>
                                    {{ $product->description }}

                                </td>
                                <td>
                                    {{ $product->stock }}

                                </td>
                                <td>
                                    {{ $product->status }}
                                </td>
                                <td>
                                    {{ $product->category->name }}


                                </td>
                                <td>


                                    <img src="{{ asset('storage/images/' . $product->image) }}" alt="Avatar"
                                        class="rounded-circle" height="70px" width="70px" />


                                </td>
                                <td>
                                    {{ $product->price }}
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn dropdown-toggle shadow-none mt-2"
                                            data-bs-toggle="dropdown">
                                            <i class="ti ti-dots-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="ti ti-pencil me-1"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="ti ti-trash me-1"></i>
                                                Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>


            </div>
            <div class="col-12 px-4">

                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>




    </div>
@endsection
