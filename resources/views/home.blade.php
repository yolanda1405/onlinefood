@extends('layouts.base')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col">

            <div class="container">
                <div class="row">
                    @foreach ($barangs as $barang)
                    <div class="col-md-4">
                        <div class="card p-1 rounded shadow mb-5" style=" width: 20rem; ">
                            <img src=" {{url('/')}}/barang/{{$barang->gambar}}" height="150" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title text-center">{{$barang->nama_barang}}</h5>
                                <table class="table">
                                    <tbody>
                                        <td> <strong> Harga </strong></td>
                                        <td> <strong> : </strong> </td>
                                        <td> Rp.{{ number_format($barang->harga)  }}</td>
                                    </tbody>
                                    <tbody>
                                        <td> <strong> Stok </strong></td>
                                        <td> <strong> : </strong> </td>
                                        <td> {{$barang->stok }} Porsi</td>
                                    </tbody>

                                </table>
                                <p class="card-text">
                                <h6><strong>Keterangan :</strong> </h6>
                                <h6>{{$barang->ket }}</h6>
                                </p>
                                <a href="/pesanan/{{$barang->id}}" class="btn btn-primary"><i class="fa fa-plus"> Tambah </i> </a>
                                <a onclick="editt(this)" data-idsp="{{$barang->id}}" role="button" class="btn btn-warning"><i class="fa fa-edit"> Edit </i> </a>
                                <a href="/barang/delete/{{$barang->id}}" class="btn btn-danger"><i class="fa fa-minus"> Hapus </i> </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>
<script src="{{url('/')}}/vendor/jquery/jquery.min.js"></script>
<script>
    function editt(ini) {
        console.log($(ini).data('idsp'))
        let idsp = $(ini).data('idsp')

        $.ajax({
            url: '/barang/editget/' + idsp,

            method: 'GET',
            success: function(data) {
                console.log(data)
                $('#modal-edit').find('.modal-body').html(data)
                $('#modal-edit').modal('show')
            },
            error: function(error) {
                console.log(error)
            }
        })
    }
</script>

<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 style="text-align: center;" class="card-title">Edit Barang</h4>
                @csrf
            </div>
        </div>
    </div>
</div>
@endsection