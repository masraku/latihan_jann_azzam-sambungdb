<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Produk Sekolah</title>
    <style>
        body { font-family: sans-serif; max-width: 800px; margin: 40px auto; padding: 0 16px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 32px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        .pesan { background: #d1fae5; padding: 8px; }
        .error { color: red; font-size: 14px; }
        .filter { display: flex; gap: 8px; align-items: center; flex-wrap: wrap; margin-bottom: 16px; }
        .info-filter { color: #555; margin-bottom: 8px; }
    </style>
</head>
<body>
    <h1>Produk Barang Sekolah</h1>

    @if (session('pesan'))
        <p class="pesan">{{ session('pesan') }}</p>
    @endif

    @php
        // Daftar kategori unik dari database untuk isi dropdown.
        // (Idealnya dikirim dari controller, ini supaya cukup ubah view saja.)
        $daftarKategori = \App\Models\Produk::select('kategori')->distinct()->orderBy('kategori')->pluck('kategori');
        $kategoriAktif = $kategori ?? null;
    @endphp

    <form method="GET" action="{{ route('produk.filter') }}" class="filter">
        <label for="kategori">Filter kategori:</label>
        <select name="kategori" id="kategori" required>
            <option value="" disabled {{ $kategoriAktif ? '' : 'selected' }}>-- Pilih kategori --</option>
            @foreach ($daftarKategori as $k)
                <option value="{{ $k }}" {{ $kategoriAktif === $k ? 'selected' : '' }}>{{ $k }}</option>
            @endforeach
        </select>
        <button type="submit">Tampilkan</button>

        @if ($kategoriAktif)
            <a href="{{ route('produk.index') }}">Tampilkan semua</a>
        @endif
    </form>

    @if ($kategoriAktif)
        <p class="info-filter">
            Menampilkan kategori <strong>{{ $kategoriAktif }}</strong> ({{ $produks->count() }} produk)
        </p>
    @endif

    <table>
        <tr>
           <th>No</th><th>Nama</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Aksi</th>
        </tr>
        @forelse ($produks as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->nama_produk }}</td>
                <td>{{ $p->kategori }}</td>
                <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                <td>{{ $p->stok }}</td>
                <td>
                    <a href="{{ route('produk.edit', $p) }}">Edit</a>
                    <form method="POST" action="{{ route('produk.destroy', $p) }}" style="display:inline"
                        onsubmit="return confirm('Yakin hapus {{ $p->nama_produk }}?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6">Belum ada produk.</td></tr>
        @endforelse
    </table>

    <h2>Tambah Produk</h2>
    <form method="POST" action="/produk">
        @csrf

        <p>
            <label>Nama</label><br>
            <input name="nama_produk" value="{{ old('nama_produk') }}">
            @error('nama_produk') <br><span class="error">{{ $message }}</span> @enderror
        </p>
        <p>
            <label>Kategori</label><br>
            <input name="kategori" value="{{ old('kategori') }}">
            @error('kategori') <br><span class="error">{{ $message }}</span> @enderror
        </p>
        <p>
            <label>Harga</label><br>
            <input name="harga" type="number" min="0" value="{{ old('harga') }}">
            @error('harga') <br><span class="error">{{ $message }}</span> @enderror
        </p>
        <p>
            <label>Stok</label><br>
            <input name="stok" type="number" min="0" value="{{ old('stok', 0) }}">
            @error('stok') <br><span class="error">{{ $message }}</span> @enderror
        </p>

        <button type="submit">Simpan</button>
    </form>
</body>
</html>





