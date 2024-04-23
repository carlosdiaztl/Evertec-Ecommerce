@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ secure_asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('css/product.css') }}">
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
        {{-- <button class="carousel-control-prev" type="button" data-mdb-target="#carouselExampleCaptions"
            data-mdb-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-mdb-target="#carouselExampleCaptions"
            data-mdb-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">next</span>
        </button> --}}
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

                <form class="w-auto py-1" style="max-width: 15rem">
                    <input type="search" class="form-control rounded-0" placeholder="Search" aria-label="Search">
                </form>

            </div>
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
    <div class="container">
        <div class="row">
            <!--Grid column-->
            <div class="col-md-6 mb-4">
                <img src={{ secure_asset($product->image) }} class="img-fluid" alt="" />
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-md-6 mb-4">
                <!--Content-->
                <div class="p-4">
                    <div class="mb-3">
                        <a href="">
                            <span class="badge bg-dark me-1">Category {{ $product->category_id }} </span>
                        </a>
                        <a href="">
                            <span class="badge bg-info me-1">New</span>
                        </a>
                        <a href="">
                            <span class="badge bg-danger me-1">Bestseller</span>
                        </a>
                    </div>

                    <p class="lead">

                        <span>{{ $product->price }}$ </span>
                    </p>

                    <strong>
                        <p style="font-size: 20px;">Description</p>
                    </strong>

                    <p>{{ $product->description }} </p>

                    <form class="d-flex justify-content-left">
                        <!-- Default input -->
                        <div class="form-outline me-1" style="width: 100px;">
                            <input type="number" value="1" class="form-control" />
                        </div>
                        <button class="btn btn-primary ms-1" type="submit">
                            Add to cart
                            <i class="fas fa-shopping-cart ms-1"></i>
                        </button>
                    </form>
                </div>
                <!--Content-->
            </div>
            <!--Grid column-->
        </div>
        <!--Grid row-->

        <hr />

        <!--Grid row-->
        <div class="row d-flex justify-content-center">
            <!--Grid column-->
            <div class="col-md-6 text-center">
                <h4 class="my-4 h4">Additional information</h4>

                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus suscipit modi sapiente illo soluta odit
                    voluptates, quibusdam officia. Neque quibusdam quas a quis porro? Molestias illo neque eum in laborum.
                </p>
            </div>
            <!--Grid column-->
        </div>
        <!--Grid row-->

        <!--Grid row-->
        <div class="row">
            <!--Grid column-->
            @if ($firstThreeProducts->count())
                @foreach ($firstThreeProducts as $productx)
                    <div class="col-lg-4 col-md-12 mb-4">
                        <img src={{ secure_asset($productx->image) }} class="img-fluid" alt="" />
                    </div>
                @endforeach


                <!--Grid column-->
            @else
                <div class="col-lg-4 col-md-12 mb-4">
                    <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Products/11.jpg" class="img-fluid"
                        alt="" />
                </div>
            @endif
        </div>

        <!-- Product -->


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
