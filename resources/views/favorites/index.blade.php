<!DOCTYPE html>
<html>
<head>
    <title>Produk Favorit</title>
    <style>
        body { margin: 20px; color: #333; }
        .btn { padding: 8px 16px; border: none; border-radius: 6px; cursor: pointer; text-decoration: none; display: inline-block; font-size: 14px; }
        .btn_blue { background: #4545a5; color: #fff6fd; }
        .btn_green { background: #7b9e87; color: #fff6fd; }
        .btn_red { background: #cb4335; color: white; }
        .table { border-collapse: collapse; width: 100%; }
        .table th, .table td { padding: 10px; border: 1px solid #ccc; }
        .table th { background-color: #f3f4f6; }
    </style>
</head>
<body>
    <h1>Produk Favorit Saya</h1>

    <p>
        <a href="{{ route('home') }}" class="btn btn_blue">Kembali ke Beranda</a>
        &nbsp;&nbsp;
        <a href="{{ route('products.index') }}" class="btn btn_green">Kembali ke Produk</a>
    </p>

    @if(session('success'))
        <p style="color: green;"><b>{{ session('success') }}</b></p>
    @endif

    <!-- Menampilkan seluruh produk fav pengguna -->
    <table class="table">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($favorites as $favorite)
                <tr style="text-align:center">
                    <td style="font-weight: bold; text-align: left;">{{ $favorite->product->name }}</td>
                    <td>
                        <form action="{{ route('favorites.destroy', $favorite->product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <!-- Hapus produk fav -->
                            @method('DELETE')
                            <button type="submit" class="btn btn_red" onclick="return confirm('Hapus produk ini dari favorit?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" style="text-align:center">Belum ada produk favorit</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>