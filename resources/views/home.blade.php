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
    <nav class="navbar navbar-expand-lg navbar-dark mt-3 mb-5 shadow p-2" style="background-color: #607D8B">
        <!-- Container wrapper -->
        <div class="container-fluid">

            <!-- Navbar brand -->
            <span class="navbar-brand">Categories:</span>

            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                data-mdb-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent2" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>

            </button>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent2">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <!-- Link -->

                    <li class="nav-item">
                        <form>
                            <input class="d-none" type="number" value="" name="search">


                            <button class="btn nav-link text-white mx-2 my-2 shadow-none" type="submit">All</button>
                        </form>
                    </li>
                    @if ($categories->count())
                        @foreach ($categories as $category)
                            <li class="nav-item">
                                <form>
                                    <input class="d-none" type="number" value="{{ $category->id }}" name="category">

                                    <button class="btn nav-link text-white mx-2 my-2 shadow-none"
                                        type="submit">{{ $category->name }}</button>
                                </form>
                            </li>
                        @endforeach
                    @else
                        <li class="nav-item">
                            <button class="btn nav-link text-white shadow-none">
                                No hay categorias para mostrar
                            </button>
                        </li>
                    @endif


                </ul>

                <!-- Search -->
                <form class="form-inline my-2 my-lg-0 d-flex">


                    <input class="form-control mr-sm-2 mx-2 form-control-sm" type="search" name="search"
                        placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline text-white my-2 my-sm-0" type="submit">Search</button>

                </form>


            </div>
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
    <div class="container">
        {{auth()->user}}

        <!-- Products -->
        <section>
            <div id="app">
                {{-- <product-component products="{{ json_encode($products) }}"></product-component> --}}
        <product-example ></product-example>
                
            </div>
           
        </section>


        <!-- Pagination -->
        {{-- {{ $products->links('pagination::bootstrap-5') }} --}}
        <!-- Pagination -->
    </div>
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
