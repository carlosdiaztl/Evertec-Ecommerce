@extends('layouts.app')
@section('content')
    <div class="container">
        <a class="btn btn-primary mb-2" href="{{ route('admin.products.create') }}">Create new product</a>
        <a class="btn btn-primary mb-2" href="{{ route('admin.categories.index') }}">View categories</a>
        @if ($products->count())
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Products</h5>

                    <form action="{{ route('admin.products.store-excel') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <input class="form-control" type="file" name="import_file" >
                        <button type="submit" class="btn btn-outline-primary"> <i class="fas fa-upload mx-1 "></i> importar</button>
                    </form>


                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="bg-secondary">
                            <tr>
                                <th>Title</th>
                                <th class="text-center">Description</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Category</th>
                                <th class="text-center">Image</th>
                                <th>Price</th>
                                <th class="text-center">Actions</th>
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


                                        <img src="{{ asset($product->image) }}" alt="Avatar" class="rounded-circle"
                                            height="70px" width="70px" />


                                    </td>
                                    <td>
                                        {{ $product->price }}
                                    </td>
                                    <td>
                                        <div class="d-flex mx-2">
                                            <a class="nav-link" href="{{ route('admin.products.show', $product) }}"><i
                                                    class="ti ti-eye" style="font-size: 24px;"></i></a>
                                            <a class="nav-link mx-1" href="{{ route('admin.products.edit', $product) }}"><i
                                                    class="ti ti-pencil" style="font-size: 24px;"></i></a>
                                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn p-0 shadow-none "><i class="ti ti-trash"
                                                        style="font-size: 24px;"></i></button>
                                            </form>
                                        </div>



                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>


                </div>
                <div class="row">
                    <div class="col-10">
                        {{ $products->links('pagination::bootstrap-5') }}
                    </div>

                    <div class="col-2 m-0">
                        <div class="demo-inline-spacing">
                            <div class="btn-group" id="hover-dropdown-demo">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                                    data-trigger="hover">
                                    Export
                                </button>
                                <ul class="dropdown-menu">
                                    <li> <a class="dropdown-item" href="{{ route('admin.products-pdf-export') }}">Pdf
                                        </a></li>
                                    <li> <a class="dropdown-item" href="{{ route('admin.products-excel-export') }}">
                                            Excel</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            @else
                <div class="card-body">
                    <strong>No hay registros</strong>
                </div>
        @endif

    </div>
@endsection
