<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use UxWeb\SweetAlert\SweetAlert;

class PesananController extends Controller
{

    // Jika Ada User Yang Belum Login Makan Di Redirect Ke Halaman Awal
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Untuk Menampilkan Barang Penjualan .
    public function index($id)
    {
        // Jika User Id Tidak Ada , Maka Page Apak Error 404
        if (empty(auth()->user()->id)) {
            return abort(404);
        }
        $barang = Barang::where('id', $id)->first();
        return view('user.index', compact('barang'));
    }


    public function update(Request $request, $id)
    {
        // Jika User Id Tidak Ada , Maka Page Apak Error 404
        if (empty(auth()->user()->id)) {
            return abort(404);
        }
        $request->validate([
            'order' => 'required',
        ]);
        $barang = Barang::where('id', $id)->first();
        // Tanggal Sekarang
        $tanggal = Carbon::now();
        //cek pesanan
        $cek = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        // jika pesanan lebih dari stok barang maka database tidak masuk dan kembali ke orderan 
        if ($request->order > $barang->stok) {
            return redirect('/pesanan/' . $id)->with('status', 'Jumlah Pesanan Tidak Boleh Lebih Dari Stok Yang Tersedia');
        }
        if (empty($cek)) {
            // pesanan di simpan ke Database
            $pesanan = new Pesanan;
            $pesanan->user_id = Auth::user()->id;
            $pesanan->tanggal = $tanggal;
            $pesanan->status = 0;
            $pesanan->jumlah_harga =  0;
            $pesanan->save();
        }
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $cek_pesanan_detail = PesananDetail::where('barang_id', $barang->id)->where('pesanan_id', $pesanan_baru->id)->first();
        // Jika cek pesan detail tidak ada , maka oder akan dibuat
        // esle jika tidak akan di update
        if (empty($cek_pesanan_detail)) {
            // input ke table pesanan detail
            $pesanan_detail = new PesananDetail;
            $pesanan_detail->barang_id = $barang->id;
            $pesanan_detail->pesanan_id = $pesanan_baru->id;
            $pesanan_detail->jumlah = $request->order;
            $pesanan_detail->jumlah_harga = $request->order * $barang->harga;
            $pesanan_detail->save();
        } else {
            $pesanan_detail = PesananDetail::where('barang_id', $barang->id)->where('pesanan_id', $pesanan_baru->id)->first();
            $pesanan_detail->jumlah =  $pesanan_detail->jumlah + $request->order;
            $harga_baru = $barang->harga * $request->order;
            $pesanan_detail->jumlah_harga = $pesanan_detail->jumlah_harga + $harga_baru;
            $pesanan_detail->update();
        }
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $kode = mt_rand(1, 99);
        $pesanan->jumlah_harga = $pesanan->jumlah_harga + $barang->harga * $request->order + $kode;
        $pesanan->update();
        alert()->success('Cek Keranjang', 'Pesanan Berhasil Di Tambahkan !');
        return redirect('keranjang')->with('status', 'Pesanan Berhasil Di Tambahkan.');
    }

    public function keranjang()
    {
        if (empty(auth()->user()->id)) {
            return abort(404);
        }
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        if (!empty($pesanan)) {
            $pesanan_detail = PesananDetail::where('pesanan_id', $pesanan->id)->get();
            return view('user.keranjang', compact('pesanan_detail', 'pesanan'));
        }
        return view('user.keranjang', compact('pesanan'));
    }

    public function destroy($id)
    {
        $pesanan_detail = PesananDetail::where('id', $id)->first();
        $pesanan = Pesanan::where('id', $pesanan_detail->pesanan_id)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga - $pesanan_detail->jumlah_harga;
        if ($pesanan->jumlah_harga < 101) {
            $pesanan->delete();
            $pesanan_detail->delete();
        } else {
            $pesanan->update();
            $pesanan_detail->delete();
        }
        alert()->warning('Terimakasih..', 'Pesanan Di Batalkan !');
        return redirect('keranjang');
    }

    public function order()
    {
        $user  = User::where('id', Auth::user()->id)->first();
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        if (empty($user->alamat)) {
            alert()->warning('Terimakasih..', 'Lengkapi Alamat Anda !');
            return redirect('keranjang');
        }
        if (empty($user->notelpon)) {
            alert()->warning('Terimakasih..', 'Lengkapi No Handphone Anda !');
            return redirect('keranjang');
        }


        if (empty($pesanan)) {
            alert()->error('', 'Tidak Ada Pesanan !');
            return redirect('home');
        }
        if ($pesanan->jumlah_harga < 100) {
            alert()->error('', 'Tidak Ada Pesanan !');
            return redirect('home');
        }
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesanan_id = $pesanan->id;

        if (Auth()->user()->saldo < $pesanan->jumlah_harga) {
            alert()->warning('Terimakasih..', 'Maaf Saldo Anda Kurang !');
            return redirect('keranjang');
        }
        $user->saldo = $user->saldo - $pesanan->jumlah_harga;
        $user->update();
        $pesanan->status = 2;
        $pesanan->update();
        $pesanan_detail =  PesananDetail::where('pesanan_id', $pesanan_id)->get();

        foreach ($pesanan_detail as $pesanan_detail) {
            $barang =  Barang::where('id', $pesanan_detail->barang_id)->first();
            $barang->stok = $barang->stok - $pesanan_detail->jumlah;
            $barang->terjual = $barang->terjual + $pesanan_detail->jumlah;
            $barang->update();
        }

        alert()->success('Terimakasih..', 'Pesanan Berhasil Di Order !');
        return redirect('/history/' . $pesanan_id);
    }

    public function invoice_transfer()
    {
        $user  = User::where('id', Auth::user()->id)->first();
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        if (empty($user->alamat)) {
            alert()->warning('Terimakasih..', 'Lengkapi Alamat Anda !');
            return redirect('keranjang');
        }
        if (empty($user->notelpon)) {
            alert()->warning('Terimakasih..', 'Lengkapi No Handphone Anda !');
            return redirect('keranjang');
        }

        if ($pesanan->jumlah_harga < 100) {
            alert()->error('', 'Tidak Ada Pesanan !');
            return redirect('home');
        }
        if (empty($pesanan)) {
            alert()->error('', 'Tidak Ada Pesanan !');
            return redirect('home');
        }

        $pesanan_id = $pesanan->id;
        $pesanan->status = 1;
        $pesanan->update();
        $pesanan_detail =  PesananDetail::where('pesanan_id', $pesanan_id)->get();

        foreach ($pesanan_detail as $pesanan_detail) {
            $barang =  Barang::where('id', $pesanan_detail->barang_id)->first();
            $barang->stok = $barang->stok - $pesanan_detail->jumlah;
            $barang->update();
        }

        alert()->success('Terimakasih..', 'Pesanan Berhasil Di Order !');
        return redirect('/history/' . $pesanan_id);
    }
    public function hapus_br($id)
    {
        $data = Barang::where('id', $id)->first();
        $data->delete();

        //Redirect setelah berhasil simpan data
        alert()->success('', 'Barang Berhasil di Hapus');
        return redirect('/home');
    }

    public function edit_br($id)
    {
        $barang = Barang::where('id', $id)->get();
        $action = route('edit_post',$id);
        // return view('/editbarang', ['databr' => $data]);
        // return view('/editbarang', compact('barang'));
        // echo $id;
        return view('/editbarang',['databr' => $barang, 'url_action'=>$action]);
    }
    public function update_br(Request $request, $id){
    $produk=Barang::where('id', $id)->first();
    $produk->nama_barang = $request->nama_barang;
    $produk->harga = $request->harga;
    $produk->stok = $request->stok;
    $produk->ket = $request->ket;
    if ($request->hasFile('gambar')) {
        $file       = $request->file('gambar');
        $extension   = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move(public_path('barang'), $filename);
        $produk->gambar = $filename;
    }else {
        $file       = $request->file('gambar');
        $extension   = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move(public_path('barang'), $filename);
        $produk->gambar = $filename;
    }
    // dd($produk);
    $produk->update();
    // return redirect('/home');
    // $request->validate([
    //     'nama_barang'=> 'required|max:255|min:1',
    //     'harga' => 'required|min:0',
    // ]);
    // $imgName =null;
    // if($request->gambar){
    // $imgName = $request->gambar->getClientOriginalName().'-'.time()
    //             .'.'. $request->gambar->extension();
    
    // $request->gambar->move(public_path('barang'), $imgName);
    // }
    
    // $produk=Barang::find($id)->update([
    //     'nama_barang'=>$request->nama_barang,
    //     'harga'=>$request->harga,
    //     'stok'=>$request->stok,
    //     'ket'=>$request->ket,
    //     'gambar'=>$imgName
    // ]);
    
    return response()->json(["status"=>true]);
}

   
}