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
    <link href="{{url('/')}}/css/sb-admin-2.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/css/costume.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body id="page-top">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav" style="background-color: orange">
        <div class="container">
            <a class="navbar-brand text-white" href=""><span class="font-weight-bold"> <i style="color: black; font-size: 30px;" class="fas fa-utensils"> ONLINE</i> Food</span></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link text-white" href="">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('register') }}">Registrasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('login') }}">Login</a>
                    </li>
                    <li>
                        <i class="fa-2x fab fa-facebook ml-3 mt-1"></i>
                        <i class="fa-2x fab fa-instagram ml-3 mt-1"></i>
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
                <a class="btn btn-primary btn-lg " href="#" role="button"> <span class="font-weight-bold">Order Sekarang</span> </a>

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
    <div class="container mb-3">
        <div class="col-lg-4 mx-auto">
            <h1 class="text-center text-dark">Makanan Tersedia</h1>
            <hr>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 mt-3 ml-3 mb-5">
                <div class="card" style="width: 18rem;">
                    <img src="{{url('/')}}/barang/sate.jpg" width="100" height="250" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h6 class="text-center">Copyright &copy; Online Food {{date('Y')}} </h6>
                </div>
            </div>
        </div>
        </div>
    </footer>














    <script src="{{url('/')}}/vendor/jquery/jquery.min.js"></script>
    <script src="{{url('/')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{url('/')}}/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="{{url('/')}}/js/sb-admin-2.min.js"></script>
    <script src="{{url('/')}}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{url('/')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="{{url('/')}}/js/demo/datatables-demo.js"></script>
    @include('sweet::alert')
</body>

</html>