@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ secure_asset('css/home.css') }}">
@endsection
@section('content')
    <!--Main layout-->

    <div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-mdb-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-mdb-target="#carouselExampleCaptions" data-mdb-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-mdb-target="#carouselExampleCaptions" data-mdb-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-mdb-target="#carouselExampleCaptions" data-mdb-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner container-carousel">
            <div class="carousel-item active">
                <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/8-col/img%282%29.jpg"
                    class="d-block w-100 h-100" alt="Wild Landscape" />
                <div class="mask" style="background-color: rgba(0, 0, 0, 0.4)"></div>
                <div class="carousel-caption d-none d-sm-block mb-5">
                    <h1 class="mb-4">
                        <strong>Special offers</strong>
                    </h1>


                </div>
            </div>
            <div class="carousel-item">
                <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/8-col/img%283%29.jpg"
                    class="d-block w-100" alt="Camera" />
                <div class="mask" style="background-color: rgba(0, 0, 0, 0.4)"></div>
                <div class="carousel-caption d-none d-md-block mb-5">
                    <h1 class="mb-4">
                        <strong>Awesome products</strong>
                    </h1>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/8-col/img%285%29.jpg"
                    class="d-block w-100" alt="Exotic Fruits" />
                <div class="mask" style="background-color: rgba(0, 0, 0, 0.4)"></div>
                <div class="carousel-caption d-none d-md-block mb-5">
                    <h1 class="mb-4">
                        <strong>New products every week</strong>
                    </h1>
                </div>
            </div>
        </div>

    </div>

    <!-- Navbar -->
   
    <!-- Navbar -->
        <!-- Products -->
        <!-- Products -->
       {{-- {{route('api.products')}} --}}
     
       
        <section>
            <div id="app">
                {{-- <product-component products="{{ json_encode($products) }}"></product-component> --}}
        <product-example  authenticated="{{ auth()->user() && auth()->user()->id ? auth()->user()->id :null}}" categories="{{json_encode($categories) }}"
            rutagetproducts="{{route('api.products') }}"
            rutasendorder={{route('orders.store')}} 
            rutaimagen={{secure_asset('')}}
            ></product-example>
                
            </div>
           
        </section>

        <!-- Pagination -->
        {{-- {{ $products->links('pagination::bootstrap-5') }} --}}
        <!-- Pagination -->
    
    <footer class="text-center text-white w-100" style="background-color: #607D8B;">

        <!--Call to action-->
        <div class="pt-4 pb-2">
            <a class="btn btn-outline-white footer-cta mx-2"> <i class="fas fa-download ms-2"></i>
            </a>
            <a class="btn btn-outline-white footer-cta mx-2">
                <i class="fas fa-graduation-cap ms-2"></i>
            </a>
        </div>
        <!--/.Call to action-->

        <hr class="text-dark">

        <div class="container">
            <!-- Section: Social media -->
            <section class="mb-3">

                <!-- Facebook -->
                <a class="btn-link btn-floating btn-lg text-white" href="#!" role="button"
                    data-mdb-ripple-color="dark"><i class="fab fa-facebook-f"></i></a>

                <!-- Twitter -->
                <a class="btn-link btn-floating btn-lg text-white" href="#!" role="button"
                    data-mdb-ripple-color="dark"><i class="fab fa-twitter"></i></a>

                <!-- Google -->
                <a class="btn-link btn-floating btn-lg text-white" href="#!" role="button"
                    data-mdb-ripple-color="dark"><i class="fab fa-google"></i></a>

                <!-- Instagram -->
                <a class="btn-link btn-floating btn-lg text-white" href="#!" role="button"
                    data-mdb-ripple-color="dark"><i class="fab fa-instagram"></i></a>

                <!-- YouTube -->
                <a class="btn-link btn-floating btn-lg text-white" href="#!" role="button"
                    data-mdb-ripple-color="dark"><i class="fab fa-youtube"></i></a>
                <!-- Github -->
                <a class="btn-link btn-floating btn-lg text-white" href="#!" role="button"
                    data-mdb-ripple-color="dark"><i class="fab fa-github"></i></a>
            </section>
            <!-- Section: Social media -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2); text-color: #E0E0E0">
            © 2023 Copyright:
            <a class="text-white" href="https://github.com/carlosdiaztl">https://github.com/carlosdiaztl.com</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!--Main layout-->
@endsection
