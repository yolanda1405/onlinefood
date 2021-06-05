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
                    <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
                </ol>
            </nav>
        </div>

        <div class="col-lg-12">
            <div class="card p-4">
                <h3 class="text-center"><i class="fa fa-shopping-cart"> Online Food's</i></h3>
                @if (!empty($pesanan))
                <p align="right"> <strong> Tanggal : {{$pesanan->tanggal}} </strong></p>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Total</th>
                                <th scope="col">Batal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pesanan_detail as $pesanan_detail )
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$pesanan_detail->barang->nama_barang}}</td>
                                <td>{{$pesanan_detail->jumlah}}</td>
                                <td align="left">Rp. {{ number_format($pesanan_detail->barang->harga) }}</td>
                                <td align="left">Rp. {{number_format($pesanan_detail->jumlah_harga)}}</td>
                                <td>
                                    <form action="{{url('/cancel-order')}}/{{$pesanan_detail->id}}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button href="a" class="btn btn-danger btn-sm" onclick="return confim('Apakah Anda Yakin ?')"> <i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" align="right"><strong>TOTAL :</strong></td>
                                <td><strong>Rp.{{number_format($pesanan->jumlah_harga)}}</strong> </td>
                                <td></td>
                            </tr>

                        </tbody>

                    </table>

                </div>
                <div class="row">
                    <div class="col-lg-9 mr-auto"></div>
                    <div class="col-lg-2"><a href="{{url('/order')}}" class="btn btn-success"> <i class="fa fa-check"></i> ORDER </a></div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection