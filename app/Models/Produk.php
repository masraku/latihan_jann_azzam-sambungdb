<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Table('produks')]
#[Fillable(['nama_produk', 'kategori', 'harga', 'stok'])]

class Produk extends Model
{
    //
}
