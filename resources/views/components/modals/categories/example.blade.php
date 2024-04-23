<div class="text-center">
    <div class="row">
        @if ($products->count())
            @foreach ($products as $product)
                <div class="col-lg-3 col-md-6 mb-4">
  
                    <div class="card w-100 h-100">
                        <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light"
                            data-mdb-ripple-color="light">
                            <img class="w-100" src={{ secure_assett($product->image) }} />
                            <a href="{{ route('product.show', $product) }}">
                                <div class="mask">
                                    <div class="d-flex justify-content-start align-items-end h-100">
                                        <h5><span class="badge bg-dark ms-2">NEW</span></h5>
                                    </div>
                                </div>
                                <div class="hover-overlay">
                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);">
                                    </div>
                                </div>
                                {{ $product->category->name }}
                            </a>
                        </div>
                        <div class="card-body">
                            <span class="text-reset">
                                <h5 class="card-title mb-2">{{ $product->title }} </h5>
                            </span>
                            {{-- <span class="text-reset overflow-auto">
                            <p>{{ $product->description }}</p>
                        </span> --}}
  
  
                        </div>
                        <div class="card-footer p-0 bg-white border-0  ">
                            <h6 class="mb-3 price">{{ $product->price }}$</h6>
  
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <h1>
                No hay productos para mostrar en el momento
            </h1>
        @endif
    </div>
  
  
  </div>