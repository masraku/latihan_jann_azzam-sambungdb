<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: 40px auto; padding: 0 16px; }
        .error { color: red; font-size: 14px; }
    </style>
</head>
<body>
    <h1>Edit Produk</h1>
    <a href="{{ route('produk.index') }}">← Kembali</a>

    <form method="POST" action="{{ route('produk.update', $produk) }}">
        @csrf
        @method('PUT')

        <p>
            <label>Nama</label><br>
            <input name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}">
            @error('nama_produk') <br><span class="error">{{ $message }}</span> @enderror
        </p>
        <p>
            <label>Kategori</label><br>
            <input name="kategori" value="{{ old('kategori', $produk->kategori) }}">
            @error('kategori') <br><span class="error">{{ $message }}</span> @enderror
        </p>
        <p>
            <label>Harga</label><br>
            <input name="harga" type="number" min="0" value="{{ old('harga', $produk->harga) }}">
            @error('harga') <br><span class="error">{{ $message }}</span> @enderror
        </p>
        <p>
            <label>Stok</label><br>
            <input name="stok" type="number" min="0" value="{{ old('stok', $produk->stok) }}">
            @error('stok') <br><span class="error">{{ $message }}</span> @enderror
        </p>

        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>
