<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Custom fonts for this template-->
    <link href="{{url('/')}}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
    <!-- Custom styles for this template-->
    <link href="{{url('/')}}/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/css/costume.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <div id="container">

            <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav" style="background-color: #ffa366">
                <div class="container">
                    <a class="navbar-brand text-white" href=""><span class="font-weight-bold"> <i style="color: black; font-size: 30px;" class="fas fa-utensils"> ONLINE</i> Food</span></a>
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <?php
                    $user = \App\Models\Pesanan::where('user_id', auth()->user()->id)->where('status', 0)->first();
                    $alert = \App\Models\Pesanan::where('status', 2)->count();
                    if (!empty($user)) {
                        $pesanan = \App\Models\PesananDetail::where('pesanan_id', $user->id)->count();
                    }
                    ?>

                    <div class="collapse navbar-collapse" id="navbarNav">

                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown no-arrow mx-1 ">
                                <a class="nav-link {{request()->is('history')?'d-none' : ''}}" href="{{url('/')}}/keranjang">
                                    <i class="fa fa-shopping-cart">
                                        @if (!empty($pesanan))
                                        <Span class="badge badge-danger"> {{$pesanan}}</Span>
                                        @endif
                                    </i>
                                </a>
                            </li>
                            @if (auth()->user()->level == 1)
                            <li class="nav-item dropdown no-arrow mx-1 ">
                                <a class="nav-link " href="{{url('dashboard')}}">
                                    <i class="fa fa-envelope">
                                        <Span class="badge badge-danger"> {{$alert}}</Span>
                                    </i>
                                </a>
                            </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline font-weight-bold small">{{Auth::user()->name}}</span>
                                    <img height="30px" width="30px" class="img-profile rounded-circle" src="{{url('/')}}/img/undraw_profile.svg">
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <p class="dropdown-item" href="{{url('profile')}}">
                                        <strong>Saldo</strong> : Rp.{{number_format( auth()->user()->saldo)}}
                                    </p>
                                    <a class="dropdown-item" href="{{url('profile')}}">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                    <a class="dropdown-item" href="{{url('history')}}">
                                        <i class="fas fa-dollar-sign fa-fw mr-2 text-gray-400"></i>
                                        History
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    @if (auth()->user()->level == 1)
                                    <div>
                                        <a class="dropdown-item" href="{{url('dashboard')}}">Dashboard</a>
                                        <a class="dropdown-item" href="{{url('/datapelanggan')}}">Data Pelanggan</a>
                                        <a class="dropdown-item" href="{{url('/datatransaksi')}}">Data Transaksi</a>
                                    </div>
                                    @endif
                                    <a class="dropdown-item" href="/logout">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div id="carouselExampleIndicators" class="carousel slide mb-4" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">

                    <div class="carousel-item active">

                        <img src="{{url('/')}}/img/s1.jpg" class="d-block w-100" alt="...">
                    </div>

                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="display-4"> <span class="font-weight-bold"> <i class="fas fa-utensils"></i> ONLINE </span> Food's </h1>
                        <hr class="my-4">
                        <p>Anda Kenyang Kami Puas !</p>
                    </div>
                    <div class="carousel-item">
                        <img src="{{url('/')}}/img/s2.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{url('/')}}/img/s3.jpg" class="d-block w-100" alt="...">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <div class="content">
                @yield('content')

            </div>
        </div>

    </div>
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="col-lg-12">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2020</span>
                </div>
            </div>
        </div>
    </footer>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!-- Bootstrap core JavaScript-->
    <script src="{{url('/')}}/vendor/jquery/jquery.min.js"></script>
    <script src="{{url('/')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{url('/')}}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{url('/')}}/js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
    <script src="{{url('/')}}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{url('/')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="{{url('/')}}/js/demo/datatables-demo.js"></script>
    @include('sweet::alert')
</body>

</html>