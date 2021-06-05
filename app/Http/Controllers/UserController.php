<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use UxWeb\SweetAlert\SweetAlert;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    public function index()
    {
        $user  = User::where('id', Auth::user()->id)->first();
        return view('user.profile', compact('user'));
    }



    public function history()
    {
        $pesanan  = Pesanan::where('user_id', Auth::user()->id)->where('status', '!=', 0)->orderBy('created_at', 'desc')->get();
        return view('user.history', compact('pesanan'));
    }




    public function detail($id)
    {
        $pesanans  = Pesanan::where('id', $id)->first();
        $pesanan_detail = PesananDetail::where('pesanan_id', $pesanans->id)->get();
        return view('user.detail-history', compact('pesanans', 'pesanan_detail'));
    }




    public function edit_profile()
    {
        $user  = User::where('id', Auth::user()->id)->first();
        return view('user.edit', compact('user'));
    }



    public function update(Request $request, $id)

    {
        User::where('id', $id)
            ->update([
                'name' => $request->name,
                'alamat' => $request->alamat,
                'notelpon' => $request->notelpon,
            ]);
        alert()->success('Tengkyu :)', 'Profile Berhasil Di Update');
        return redirect('profile');
    }
}
