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
        return redirect()->route('produk.index')->with('pesan', 'Produk berhasil ditambahkan');

    }

    //Get /produk/{produk}/edit -> tampilkan form edit produk
    public function edit(Produk $produk){
        return view('produk.edit', ['produk' => $produk]);
    }

    //Put /produk/{produk} -> simpan perubahan data produk
    public function update (Request $request, Produk $produk){
        $data = $request -> validate([
            'nama_produk' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:255'],
            'harga' => ['required', 'integer', 'min:0'],
            'stok' => ['required', 'integer', 'min:0']
        ]);
        $produk->update($data);
        return redirect()->route('produk.index')->with('pesan', 'Produk berhasil diubah');
    }

    //Delete /produk/{produk} -> hapus data produk
    public function destroy(Produk $produk){
        $produk->delete();
        return redirect()->route('produk.index')->with('pesan', 'Produk berhasil dihapus');
    }

    //Filter /produk/filter -> filter produk berdasarkan kategori
    public function filter(Request $request){
        $kategori = $request->input('kategori');
        $produks = Produk::where('kategori', $kategori)->orderBy('nama_produk', 'asc')->get();
        return view('produk.index', ['produks'=>$produks, 'kategori'=>$kategori]);
    }
}
