<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $datauser = User::all();
        $pesanans = Pesanan::where('status', 2)->get();
        $pesanan_details = User::leftJoin('pesanans', 'pesanans.user_id', '=', 'users.id')->where('status', 2)->get();
        return view('admin.dashboard', compact('datauser', 'pesanan_details'));
    }

    public function datapelanggan()
    {
        return view('admin.datapelanggan', ['users' => User::where('level', 2)->get()]);
    }
    public function datatransaksi()
    {
        $transaksi = Pesanan::leftJoin('pesanan_details', 'pesanan_details.pesanan_id', '=', 'pesanans.id')
            ->leftJoin('users', 'users.id', '=', 'pesanans.user_id')->where('status', 3)->orderBy('pesanans.updated_at', 'desc')->get();
        return view('admin.datatransaksi', compact('transaksi'));
    }

    public function terima_order($id)
    {
        $pesanan2 = Pesanan::where('id', $id)->first();
        if (!empty($pesanan2)) {
            $pesanan2->status = 3;
            $pesanan2->update();
        }
        alert()->success('', 'Pengambilan Order Berhasil !');
        return redirect('dashboard');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_barang' => 'required',
                'harga' => 'required',
                'stok' => 'required',
                'stok' => 'required',
            ]
        );
        $produk = new Barang;
        $produk->nama_barang = $request->nama_barang;
        $produk->harga = $request->harga;
        $produk->stok = $request->stok;
        $produk->ket = $request->ket;
        if ($request->hasFile('gambar')) {
            $file       = $request->file('gambar');
            $extension   = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('barang', $filename);
            $produk->gambar = $filename;
        } else {
            return $request;
            $produk->gambar = '';
        }
        $produk->save();
        alert()->success('', 'Barang Berhasil Di Tambahkan');
        return redirect('home');
    }
}
