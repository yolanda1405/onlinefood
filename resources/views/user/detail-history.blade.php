@extends('layouts.link')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <a href="{{url('/')}}/home"> <i class="fa fa-arrow-left"></i> Kembali</a>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb shadow-sm">
                    <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{url('history')}}">History</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Pesanan</li>
                </ol>
            </nav>
        </div>
        @if ($pesanans->status < 2) <div class="col-lg-12 mb-3">
            <div class="card">
                <div class="card-body shadow-sm">
                    <div>&bull; Orderan akan diproses secara otomatis (&plusmn; 5-30 menit) setelah anda melakukan pembayaran <code>*diluar jam offline sistem (22:00-04:00)</code></div>
                    <div>&bull; Pembayaran orderan dapat melalui <b><code>Bank BCA (014), No Rek : 0123548679 an Online Food</code></b></div>
                    <div>&bull; <b>
                            <font color="red">Anda wajib transfer sesuai dengan nominal yang ditampilkan (hingga 3 digit terakhir)</font>
                        </b> dan diharapkan melampirkan Nama lengkap & Nomor telpon yang dapat di hubungi.</div>
                    <div>&bull; <b>
                            <font color="red">Jika anda mentransfer tidak sesuai nominal, maka proses donasi tidak akan terproses secara otomatis. (silahkan hubungi admin)</font>
                        </b></div>
                    <div>&bull; Jika dalam 24 jam setelah anda transfer dan makanan diterima, silahkan hubungi admin.</div>
                    <div>&bull; Permintaan orderan akan otomatis expired jika dalam 24 jam anda tidak melakukan pembayaran.</div>
                </div>
            </div>
    </div>
    @endif
    <div class="col-lg-12">
        <div class="card p-4 shadow-sm">
            <h3 class="text-center"><i class="fa fa-shopping-cart"> Invoice Online Foods</i></h3>
            @if (!empty($pesanans))
            <p align="right"> <strong> Status :
                    @if ($pesanans->status == 1)
                    <Span class="badge badge-warning badge-sm text-dark">Menunggu Pembayaran</Span>
                    @elseif($pesanans->status == 2)
                    <Span class="badge badge-info badge-sm text-dark">Sedang Di Proses</Span>
                    @elseif($pesanans->status == 3)
                    <Span class="badge badge-success badge-sm text-dark">Selesai</Span>
                    @endif
                </strong></p>
            <p align="right"> <strong> Tanggal : {{$pesanans->tanggal}} </strong></p>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesanan_detail as $pesanan_detail )

                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$pesanan_detail->barang->nama_barang}}</td>
                            <td>{{$pesanan_detail->jumlah}}</td>
                            <td>Rp. {{ number_format($pesanan_detail->barang->harga) }}</td>
                            <td>Rp. {{number_format($pesanan_detail->jumlah_harga)}}</td>

                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" align="right">
                                @if ($pesanans->status == 1)
                                <strong>Total Yang Harus Di Transfer :</strong>
                                @elseif($pesanans->status == 2)
                                <strong>Total :</strong>
                                @elseif($pesanans->status == 3)
                                <strong>Total :</strong>
                                @endif
                            </td>
                            <td><strong>Rp.{{number_format($pesanans->jumlah_harga)}}</strong> </td>
                        </tr>
                        <tr>
                            @if ($pesanans->status > 1)
                            <td colspan="4" align="right">
                                <strong>Sisa Saldo :</strong>
                            </td>
                            <td><strong>Rp.{{number_format(auth()->user()->saldo)}}</strong> </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
</div>
</div>
@endsection