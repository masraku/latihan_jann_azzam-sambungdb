<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SellerProdukController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'nama_produk' => ['required', 'string', 'max:255'],
            'kategori'=> ['required', 'string','max:255'],
            'harga'=> ['required', 'integer', 'min:0'],
            'stok'=> ['required', 'integer', 'min:0'],
        ]);

        //id seller otomatis terisi dari seller yang login
        $request->user()->produks()->create($data);
        return redirect()->route('seller.dashboard')->with('pesan', 'Produk berhasil ditambahkan');
    }
}
