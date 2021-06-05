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
                    <li class="breadcrumb-item active" aria-current="page">History</li>
                </ol>
            </nav>
        </div>

        <div class="col-lg-12">
            <div class="card p-4 bg-light">
                <h3 class="text-center"><i class="fa fa-shopping-cart"> History Pembelian </i></h3>
                <table class="table table-striped">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanngal</th>
                            <th scope="col">Status</th>
                            <th scope="col">Total Harga</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($pesanan as $pesanan)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$pesanan->tanggal}}</td>
                            <td>
                                @if ($pesanan->status == 1)
                                <Span class="badge badge-warning badge-sm text-dark">Menunggu Pembayaran</Span>
                                @elseif($pesanan->status == 2)
                                <Span class="badge badge-info badge-sm text-dark">Sedang Di Proses</Span>
                                @elseif($pesanan->status == 3)
                                <Span class="badge badge-success badge-sm text-dark">Selesai</Span>
                                @endif
                            </td>
                            <td>
                                Rp.{{number_format( $pesanan->jumlah_harga )}}
                            </td>
                            <td><a href="{{url('/history')}}/{{$pesanan->id}}" class="btn btn-primary btn-sm"> <i class="fa fa-info"></i> Detail </a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection