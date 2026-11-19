<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;

#[Table('produks')]
#[Fillable(['nama_produk', 'kategori', 'harga', 'stok'])]

class Produk extends Model
{
    public function seller(){
        return $this->belongsTo(User::class, 'id_seller');
    }
}
