<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;


class ProdukController extends Controller
{
    //Get /produk -> tampilkan daftar produk nya
    public function index(){
        $produks = Produk::orderBy('nama_produk', 'asc')->get();
        return view('produk.index', ['produks' =>$produks]);
    }

    //Post /produk -> simpan data produk baru
    public function store(Request $request){
        $data = $request->validate([
            'nama_produk' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:255'],
            'harga' => ['required', 'integer', 'min:0'],
            'stok' => ['required', 'integer', 'min:0'],
        ]);
        Produk::create($data);
        return redirect()->route('produk.index');

    }
}
