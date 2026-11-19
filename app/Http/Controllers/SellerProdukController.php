<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class SellerProdukController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'nama_produk' => ['required', 'string', 'max:255'],
            'kategori'=> ['required', 'string','max:255'],
            'harga'=> ['required', 'integer', 'min:0'],
            'stok'=> ['required', 'integer', 'min:0'],
            'photo'=> ['nullable', 'image', 'max:2048'], //maksimal aku buat 2mb ye
        ]);

        //id seller otomatis terisi dari seller yang login
        unset($data['photo']);
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('produk', 'public');
        }
        $request->user()->produks()->create($data);
        return redirect()->route('seller.dashboard')->with('pesan', 'Produk berhasil ditambahkan');
    }

    public function edit (Produk $produk){
        Gate::authorize('update', $produk);
        return view('seller.produk-edit', compact('produk'));
    }

    public function update(Request $request, Produk $produk){
        Gate::authorize('update', $produk);
        $data = $request->validate([
            'nama_produk' => ['required', 'string', 'max:255'],
            'kategori'=> ['required', 'string', 'max:255'],
            'harga'=> ['required', 'integer', 'min:0'],
            'stok'=> ['required', 'integer', 'min:0'],
            'photo'=> ['nullable', 'image', 'max:2048'],
        ]);

        unset($data['photo']);
        if ($request->hasFile('photo')) {
            if ($produk->photo) {
                Storage::disk('public')->delete($produk->photo);
            }
            $data['photo'] = $request->file('photo')->store('produk', 'public');
        }

        $produk->update($data);
        return redirect()->route('seller.dashboard')->with('pesan', 'Produk berhasil diubah');
    }

    public function destroy(Produk $produk){
        Gate::authorize('delete', $produk);

        if ($produk->photo){
            Storage::disk('public')->delete($produk->photo);
        }
        $produk->delete();
        return redirect()->route('seller.dashboard')->with('pesan', 'Produk berhasil dihapus');
    }
}
