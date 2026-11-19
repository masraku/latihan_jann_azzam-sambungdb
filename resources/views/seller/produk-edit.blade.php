<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
</head>
<body>
    <h1>Edit Produk</h1>

    @if ($errors->any())
        <ul style="color:red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('seller.produk.update', $produk) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <p>Nama produk<br>
            <input type="text" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" required></p>
        <p>Kategori<br>
            <input type="text" name="kategori" value="{{ old('kategori', $produk->kategori) }}" required></p>
        <p>Harga<br>
            <input type="number" name="harga" value="{{ old('harga', $produk->harga) }}" min="0" required></p>
        <p>Stok<br>
            <input type="number" name="stok" value="{{ old('stok', $produk->stok) }}" min="0" required></p>
        <p>Foto<br>
            @if ($produk->photo)
                <img src="{{ asset('storage/'. $produk->photo) }}" alt="{{ $produk->nama_produk }}" width="120"><br>
            @endif
            <input type="file" name="photo" accept="image/*"></p>

        <button type="submit">Simpan</button>
        <a href="{{ route('seller.dashboard') }}">Batal</a>
    </form>
</body>
</html>
