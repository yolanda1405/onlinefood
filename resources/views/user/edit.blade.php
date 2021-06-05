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
                    <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
                </ol>
            </nav>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-6 mx-auto">
                        <div class="card">
                            <div class="card-body">
                                <h2> <i class="fa fa-user"></i> Edit User</h2>
                                <hr>
                                <form action="/edit/{{$user->id}}/update" method="post">
                                    @method('patch')
                                    @csrf
                                    <div class="mt-2">
                                        <label for=""><strong> Email</strong> </label>
                                        <input type="text" class="form-control col-lg" value="{{$user->email}}" name="email" readonly>
                                    </div>
                                    <div class="mt-2">
                                        <label for=""> <strong> Nama Lengkap </strong></label>
                                        <input type="text" class="form-control col-lg" value="{{$user->name}}" name="name">
                                    </div>

                                    <div class="mt-2">
                                        <label for=""><strong> No Handphone</strong> </label>
                                        <input type="number" class="form-control col-lg" value="{{$user->notelpon}}" name="notelpon">
                                    </div>
                                    <label for="" class="mt-2"><strong> Alamat </strong> </label>
                                    <div class="">
                                        <textarea name="alamat" rows="3" class="form-control col-lg">{{$user->alamat}}</textarea>
                                    </div>
                                    <div class="mt-2">
                                        <button class="btn btn-primary btn-block"> Update Profile </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection