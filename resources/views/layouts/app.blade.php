<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Carlos E-commerce</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/mdb.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @yield('css')

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <!--Main Navigation-->
    <header>
        <!-- Sidebar -->
        <nav id="sidebarMenu"
            class="{{ auth() && auth()->user() ? 'collapse d-lg-block sidebar collapse bg-white' : 'd-none' }}">

            <div class="position-sticky">
                <div class="list-group list-group-flush mx-3 mt-4">
                    @inject('role', 'App\Services\Roles')
                    @if ($role->Admin())
                        <a href="#" class="list-group-item list-group-item-action py-2 ripple"
                            aria-current="true">
                            <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Main dashboard</span>
                        </a>
                    @endif
                    @can('admin.users.index')
                        <a href="{{ route('admin.home') }}" class="list-group-item list-group-item-action py-2 ripple">
                            <i class="fas fa-chart-area fa-fw me-3"></i><span>Panel administrador </span>
                        </a>
                        <a href="{{ route('admin.users.index') }}"
                            class="list-group-item list-group-item-action py-2 ripple"><i
                                class="fas fa-users fa-fw me-3"></i><span>Users</span></a>
                    @endcan
                    @can('admin.products.index')
                        <a href="{{ route('admin.products.index') }}"
                            class="list-group-item list-group-item-action py-2 ripple"><i
                                class="fas fa-store fa-fw me-3"></i><span>Products</span></a>
                    @else
                        <a href="{{ route('home') }}" class="list-group-item list-group-item-action py-2 ripple"><i
                                class="fas fa-store fa-fw me-3"></i><span>Products</span></a>
                    @endcan
                    @if (auth() && auth()->user())
                        <a href="{{ route('user.edit', auth()->user()->id) }}"
                            class="list-group-item list-group-item-action py-2 ripple "><i
                                class="fas fa-user fa-fw me-3"></i><span>Profile</span></a>
                    @endif

                    {{-- <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i
                            class="fas fa-lock fa-fw me-3"></i><span>Password</span></a>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i
                            class="fas fa-chart-line fa-fw me-3"></i><span>Analytics</span></a>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="fas fa-chart-pie fa-fw me-3"></i><span>SEO</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i
                            class="fas fa-chart-bar fa-fw me-3"></i><span>Orders</span></a>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i
                            class="fas fa-globe fa-fw me-3"></i><span>International</span></a>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i
                            class="fas fa-building fa-fw me-3"></i><span>Partners</span></a>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i
                            class="fas fa-calendar fa-fw me-3"></i><span>Calendar</span></a>

                    <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i
                            class="fas fa-money-bill fa-fw me-3"></i><span>Sales</span></a> --}}
                </div>
            </div>
        </nav>
        <!-- Sidebar -->

        <!-- Navbar -->
        <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
            <!-- Container wrapper -->
            <div class="container-fluid">
                <!-- Toggle button -->
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu"
                    aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Brand -->
                <span class="navbar-brand">
                    <img src="https://mdbootstrap.com/img/logo/mdb-transaprent-noshadows.png" height="25"
                        alt="" loading="lazy" />
                </span>
                <!-- Search form -->
                {{-- <form class="d-none d-md-flex input-group w-auto my-auto">
                    <input autocomplete="off" type="search" class="form-control rounded"
                        placeholder='Search (ctrl + "/" to focus)' style="min-width: 225px" />
                    <span class="input-group-text border-0"><i class="fas fa-search"></i></span>
                </form> --}}

                <!-- Right links -->
                <ul class="navbar-nav ms-auto d-flex flex-row">
                    <!-- Notification dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#"
                            id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bell"></i>
                            <span class="badge rounded-pill badge-notification bg-danger">1</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Some news</a></li>
                            <li><a class="dropdown-item" href="#">Another news</a></li>
                            <li>
                                <a class="dropdown-item" href="#">Something else</a>
                            </li>
                        </ul>
                    </li>


                    <li class="nav-item me-3 me-lg-0">
                        <a class="nav-link" href="https://github.com/carlosdiaztl/carlosdiaztl">
                            <i class="fab fa-github"></i>
                        </a>
                    </li>

                    <!-- Icon dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#" id="navbarDropdown"
                            role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                            <i class="united kingdom flag m-0"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="#"><i class="united kingdom flag"></i>English
                                    <i class="fa fa-check text-success ms-2"></i></a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>

                            <li>
                                <a class="dropdown-item" href="#"><i class="spain flag"></i>Español</a>
                            </li>

                        </ul>
                    </li>

                    <!-- Avatar -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
                            id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown"
                            aria-expanded="false">
                            @if (auth() && auth()->user()->image)
                                <img src="{{ asset(auth()->user()->image) }}" class="rounded-circle" height="22"
                                    alt="" loading="lazy" />
                            @else
                                <img src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg"
                                    class="rounded-circle" height="22" alt="" loading="lazy" />
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            @guest
                                @if (Route::has('login'))
                                    <li class="dropdown-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="dropdown-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                {{-- <a id="navbarDropdown" class="dropdown-item" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a> --}}


                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                <a class="dropdown-item" href="{{ route('user.edit', auth()->user()->id) }}">
                                    Ver perfil
                                </a>






                            @endguest
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
    </header>
    <!--Main Navigation-->

    <!--Main layout-->
    <main class="{{ auth() && auth()->user() ? 'mt-5 pt-3 sidebarauth' : 'mt-5 pt-3' }}">

        @yield('content')
        @if (isset($errors) && $errors->any())
            <div class="container text-center">


                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    html: '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
                })
            </script>
        @endif
    </main>
    <!--Main layout-->
    <!-- MDB -->
    <script type="text/javascript" src="{{ asset('js/mdb.min.js') }}"></script>
    <!-- Custom scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Scripts -->
    @yield('scripts')

</body>
@if (session()->has('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'congratulations',
            text: "{{ session()->get('success') }}",
        })
    </script>
@endif



</html>
