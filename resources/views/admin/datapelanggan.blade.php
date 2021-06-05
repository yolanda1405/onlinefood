@extends('layouts.link')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            @if (session('status'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Pemberitahuan !</strong> {{session('status')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <a href="/home"> <i class="fa fa-arrow-left"></i> Kembali</a>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Pelanggan</li>
                </ol>
            </nav>
        </div>
        <!-- Begin Page Content -->
        <div class="container">
            <div class="col-lg-12">
                <!-- Page Heading -->
                <h1 class="h2 mb-2 text-gray-800">Data Pelanggan</h1>

                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h6 class=" font-weight-bold text-primary">Data Pelanggan</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="dataTable">
                                <thead align="left">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Handphone</th>
                                        <th>Saldo</th>
                                    </tr>
                                </thead>
                                <tbody align="left">
                                    @foreach ($users as $users)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$users->name}}</td>
                                        <td>{{$users->alamat}}</td>
                                        <td>{{$users->notelpon}}</td>
                                        <td>Rp.{{number_format($users->saldo) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection