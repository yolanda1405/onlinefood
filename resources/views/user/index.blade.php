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
                    <li class="breadcrumb-item active" aria-current="page">{{$barang->nama_barang}}</li>
                </ol>
            </nav>
        </div>

        <div class="col-lg-12">
            <div class="card mb-3">
                <div class=" card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <img src=" {{url('/')}}/barang/{{$barang->gambar}}" width="100%" class="rounded mx-a d-block" alt="">
                        </div>
                        <div class="col-lg-6">
                            <h3>{{$barang->nama_barang}}</h3>
                            <table class="table ">
                                <tbody>
                                    <tr>
                                        <td>Harga</td>
                                        <td>:</td>
                                        <td>Rp. {{number_format($barang->harga)}}</td>
                                    </tr>
                                    <tr>
                                        <td>Stok</td>
                                        <td>:</td>
                                        <td>{{$barang->stok}} Porsi</td>
                                    </tr>

                                    <tr>
                                        <td>Jumlah Pesanan</td>
                                        <td>:</td>

                                        <td>
                                            <form action="/pesanan/order/{{$barang->id}}" method="POST">
                                                @csrf
                                                <input type="text" class="form-control" name="order" require>
                                                <button type="submit" class="btn btn-primary btn-block mt-3"><i class="fa fa-shopping-cart"> Order </i> </button>
                                        </td>
                                    </tr>
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