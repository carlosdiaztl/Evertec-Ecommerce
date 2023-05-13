@extends('layouts.app')
@section('content')
    <div class="container">

        <a class="btn btn-primary mb-2" href="{{ route('admin.categories.create') }}">Create new category</a>
        @if ($categories->count())
            <div class="card">
                <h5 class="card-header">categories</h5>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="bg-secondary">
                            <tr>
                                <th>Name</th>
                                <th class="text-center">Description</th>
                                <th>Products associate</th>

                                <th class="text-star">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($categories as $category)
                                <tr>
                                    <td>
                                        {{ $category->name }}
                                    </td>
                                    <td>
                                        {{ $category->description }}

                                    </td>
                                    <td>
                                        {{ $category->products->count() }}

                                    </td>


                                    <td>
                                        <div class="d-flex mx-2">
                                            <a class="nav-link" href="{{ route('admin.categories.show', $category) }}"><i
                                                    class="ti ti-eye" style="font-size: 24px;"></i></a>
                                            <a class="nav-link mx-1"
                                                href="{{ route('admin.categories.edit', $category) }}"><i
                                                    class="ti ti-pencil" style="font-size: 24px;"></i></a>

                                            @if ($category->products->count())
                                                <button ttype="button" class="btn p-0 shadow-none" data-bs-toggle="modal"
                                                    data-bs-target="#deleteCategoryModal"><i class="ti ti-trash"
                                                        style="font-size: 24px;"></i></button>
                                            @else
                                                <form method="POST"
                                                    action="{{ route('admin.categories.destroy', $category) }}">
                                                    @csrf
                                                    @method('DELETE')




                                                    <button type="submit" class="btn p-0 shadow-none "><i
                                                            class="ti ti-trash" style="font-size: 24px;"></i></button>
                                        </div>
                                        </form>
                            @endif
                </div>
                </td>
                </tr>
                <x-modals.categories.categoryDelete :category="$category">
                </x-modals.categories.categoryDelete>
        @endforeach
        </tbody>
        </table>
    </div>
    <div class="col-12 px-4">
        {{ $categories->links('pagination::bootstrap-5') }}
    </div>
    </div>
@else
    <div class="card-body">
        <strong>No hay registros</strong>
    </div>
    @endif

    </div>


@endsection
