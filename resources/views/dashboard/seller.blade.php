<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Seller</title>
</head>
<body>
    <h1> Selamat Datang, {{ Auth::user()->name }} {{Auth::user()->email}} </h1>
    <p> Dashboard {{ Auth::user()->nama_toko ?? 'Seller' }} </p>

     @if (session('pesan'))
        <p style="color:green">{{ session('pesan') }}</p>
    @endif

    {{-- pesan error validasi --}}
    @if ($errors->any())
        <ul style="color:red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <h2>Tambah Barang</h2>
    <form method="POST" action="{{ route('seller.produk.store') }}">
        @csrf
        <input type="text"   name="nama_produk" value="{{ old('nama_produk') }}" placeholder="Nama produk" required>
        <input type="text"   name="kategori"    value="{{ old('kategori') }}"    placeholder="Kategori" required>
        <input type="number" name="harga"       value="{{ old('harga') }}"       placeholder="Harga" min="0" required>
        <input type="number" name="stok"        value="{{ old('stok') }}"        placeholder="Stok" min="0" required>
        <button type="submit">Tambah</button>
    </form>

    <h2>Barang Saya ({{ $produks->count() }})</h2>
    <table border="1" cellpadding="6">
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Stok</th>
        </tr>
        @forelse ($produks as $produk)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $produk->nama_produk }}</td>
                <td>{{ $produk->kategori }}</td>
                <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                <td>{{ $produk->stok }}</td>
            </tr>
        @empty
            <tr><td colspan="5">Belum ada barang.</td></tr>
        @endforelse
    </table>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
