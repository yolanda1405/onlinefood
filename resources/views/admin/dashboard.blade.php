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
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </div>

        <div class="col">
            <div class="card mb-3">
                <div class="card-body">
                    <a href="" data-toggle="modal" data-target="#logoutModal" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Tambah Barang</a>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card p-4">
                <div class="row">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Pelangan</div>
                                        <?php
                                        $pelanggan = \App\Models\User::where('level', 2)->get()->count();
                                        $order = \App\Models\Pesanan::where('status', 2)->get()->count();
                                        $pendapatan = \App\Models\Pesanan::whereIn('status', [2, 3])->sum('jumlah_harga');
                                        ?>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$pelanggan}}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-user fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Total Pendapatan</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.{{number_format( $pendapatan)}}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Pending Requests</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$order}}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            Order Masuk
                        </div>
                        <div class="card-body">



                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>No Handphone</th>
                                        <th>Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pesanan_details as $pesanan_details )
                                    <tr>
                                        <td scope="row">{{$loop->iteration}}</td>
                                        <td>{{$pesanan_details->name}}</td>
                                        <td align="left">{{$pesanan_details->alamat}}</td>
                                        <td align="left">+62 {{$pesanan_details->notelpon}}</td>
                                        <td>
                                            @if ($pesanan_details->status == 2)
                                            <span class="badge badge-warning"> Order </span>
                                            @endif
                                        </td>
                                        <td class="text-center"> <a href="{{url('/terimaorder')}}/{{$pesanan_details->id}}" class="btn btn-success btn-sm"><span><i class="fa fa-check"></i> Terima Order</span></a>
                                        </td>
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
<div class="modal fade " id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Input Barang</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/tambahbarang" enctype="multipart/form-data" method="post">
                    @csrf
                    <div>
                        <label for="">Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang">
                        @error('nama_barang')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="">Harga Barang</label>
                        <input type="number" class="form-control" name="harga" require>
                        @error('harga')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="">Stock Barang</label>
                        <input type="number" class="form-control" name="stok">
                        @error('stok')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <label for="">Bonus</label>
                        <select name="ket" id="" class="form-control">
                            <option value="Tidak Ada."> Pilih Bonus </option>
                            <option value="Gratis 2 Minuman"> Gratis 2 Minuman" </option>
                            <option value="Beli 3 Gratis 1"> Beli 3 Gratis 1 </option>
                            <option value="Beli 1 Gratis 1"> Beli 3 Gratis 1 </option>
                        </select>
                    </div>
                    <div>
                        <label for="">Upload Gambar</label>
                        <input type="file" class="form-control" name="gambar">
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-sm btn-success" style="width: 200px;"> Simpan </button>
                        <button type="reset" class="btn btn-sm btn-danger"> Reset </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</div>
@endsection