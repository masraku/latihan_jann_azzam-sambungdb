<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama_produk' => 'Buku Tulis Sidu 38 lbr', 'kategori' => 'Buku', 'harga' => 4000, 'stok' => 100],
            ['nama_produk' => 'Pensil 2B Faber-Castell', 'kategori' => 'Alat Tulis', 'harga' => 3500, 'stok' => 80],
            ['nama_produk' => 'Penghapus Joyko', 'kategori' => 'Alat Tulis', 'harga' => 2000, 'stok' => 60],
            ['nama_produk' => 'Penggaris 30 cm', 'kategori' => 'Alat Tulis', 'harga' => 5000, 'stok' => 40],
            ['nama_produk' => 'Tas Ransel', 'kategori' => 'Tas', 'harga' => 150000, 'stok' => 10],
            ['nama_produk' => 'Seragam Putih SD', 'kategori' => 'Seragam', 'harga' => 85000, 'stok' => 25],
        ];

        foreach ($data as $item) {
            Produk::create($item);
        }
    }
}
