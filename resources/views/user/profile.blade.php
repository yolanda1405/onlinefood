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
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </nav>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body bg-gray-100">
                            <h3><i class="fa fa-user"> Profile-Ku</i></h3>
                            <hr>
                            <div class="row">
                                <div class="col-lg-10">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <strong> Nama</strong>
                                                </td>
                                                <td>
                                                    :
                                                </td>
                                                <td>
                                                    {{$user->name}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>Email</strong>
                                                </td>
                                                <td>
                                                    :
                                                </td>
                                                <td>
                                                    {{$user->email}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong> Role</strong>
                                                </td>
                                                <td>
                                                    :
                                                </td>
                                                <td>
                                                    @if ($user->level == 1)
                                                    <span class="badge badge-info badge-sm"> Admin </span>
                                                    @else
                                                    <span class="badge badge-dark badge-sm"> Pelanggan </span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>No Handphone</strong>
                                                </td>
                                                <td>
                                                    :
                                                </td>
                                                <td>
                                                    +62 {{$user->notelpon}}
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>
                                                    <strong>Alamat</strong>
                                                </td>
                                                <td>
                                                    :
                                                </td>
                                                <td>
                                                    {{$user->alamat}}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-2 mt-3">
                                    <a href="{{url('/')}}/edit" class="btn btn-warning btn-block btn-sm"> <i class="fa fa-user-edit"></i> Edit Profile </a>
                                    <a href="{{url('history')}}" class="btn btn-info btn-block "> Check Riwayat </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection