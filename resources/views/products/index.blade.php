<!DOCTYPE html>
<html>
<head>
    <title>Daftar Produk</title>
    <style>
        .btn {
            padding: 5px 10px;
            text-decoration: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f2f2f2;
            color: black;
            font-size: 14px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<!-- Halaman daftar all product -->
<h1>Daftar Produk</h1>

@if(Auth::check() && Auth::user()->role == 'admin')
    <p>
        <a href="{{ route('admin.dashboard') }}" class="btn">
            Kembali ke Beranda Admin
        </a>
        <!-- Button 'tambah produk' hanya untuk admin -->
        &nbsp;&nbsp;
        <a href="{{ route('products.create') }}" class="btn">
            Tambah Produk
        </a>
    </p>
@else
    <p>
        <a href="{{ route('home') }}" class="btn">
            Kembali ke Beranda
        </a>
    </p>
@endif
<br>

<table border="1" cellpadding="10">
    <tr>
        <th>Nama</th>
        <th>Harga</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($products as $product)
    <tr>
        <!-- Menampilkan nama product -->
        <td>{{ $product->name }}</td>
        <td>Rp {{ number_format($product->price, 2, ',', '.') }}</td>
        <!-- Status stok product -->
        <td>
            @if($product->stock > 0)
                Tersedia
            @else
                Kosong
            @endif
        </td>
        <td>
            <!-- Button detail product (bisa diakses semua user) -->
            <a href="{{ route('products.show', $product->id) }}" class="btn">
                Detail
            </a>
            
            <!-- Button edit dan delete product (admin only) -->
            @if(Auth::check() && Auth::user()->role == 'admin')
                <a href="{{ route('products.edit', $product->id) }}" class="btn">
                    Ubah
                </a>
                <!-- Form delete product -->
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn" onclick="return confirm('Hapus product ini?')">
                        Hapus
                    </button>
                </form>
            @endif
        </td>
    </tr>
    @endforeach
</table>
</body>
</html>