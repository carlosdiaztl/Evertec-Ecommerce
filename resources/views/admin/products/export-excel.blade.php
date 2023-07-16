<div class="container">

    @if ($products->count())
        <div class="card">

            <div class="table-responsive">
                <table class="table">
                    <thead class="bg-secondary">
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th class="text-center">Description</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Category</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($products as $product)
                            <tr>
                                <td>
                                    {{ $product->id }}
                                </td>
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
                                    {{ $product->price }}
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros</strong>
            </div>
    @endif

</div>
