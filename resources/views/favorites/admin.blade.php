<!DOCTYPE html>
<html>
<head>
    <title>Daftar Produk Favorit</title>
    <style>
        body { margin: 20px; color: #333; }
        .btn { padding: 8px 16px; border: none; border-radius: 6px; cursor: pointer; text-decoration: none; display: inline-block; font-size: 14px; }
        .btn_blue { background: #4545a5; color: #fff6fd; }
        .table { border-collapse: collapse; width: 100%; }
        .table th, .table td { padding: 10px; border: 1px solid #ccc; }
        .table th { background-color: #f3f4f6; }
    </style>
</head>
<body>
    <h1>Daftar Produk Favorit</h1>
    <p>
        <a href="{{ route('admin.dashboard') }}" class="btn btn_blue">
            Kembali ke Beranda Admin
        </a>
    </p>
    
    <!-- Menampilkan total semua produk fav dari seluruh pengguna -->
    <table class="table">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Jumlah Favorit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($favorites as $favorite)
            <tr style="text-align:center">
                <td style="font-weight: bold; text-align: left;">{{ $favorite->product->name }}</td>
                <td>{{ $favorite->total }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
