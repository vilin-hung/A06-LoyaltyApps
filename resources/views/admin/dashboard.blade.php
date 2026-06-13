<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <style>
        body {margin: 20px; color: #333; }

        /* Navigasi */
        .nav { margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid #ccc; }
        .nav_link { text-decoration: none; color: #4545a5; margin-right: 15px; font-weight: bold; }
        
        /* Fitur admin */
        .admin { list-style-type: none; padding: 0; margin: 0; }
        .admin_fitur { padding: 10px 0; }
        .admin_fitur a { text-decoration: none; color: #333333; font-weight: bold;}
        .admin_fitur a:hover { color: #4545a5; }
    </style>
</head>
<body>
    <nav class="nav">
        <a href="{{ route('admin.dashboard') }}" class="nav_link">Beranda</a>
        <a href="{{ route('logout') }}" class="nav_link" style="color: #cb4335;">Keluar</a>
    </nav>

    <h1>Beranda Admin</h1>
    <ul class="admin">
        <li class="admin_fitur"><a href="{{ route('admin.users') }}">Daftar Pengguna</a></li>
        <li class="admin_fitur"><a href="{{ route('news.index') }}">Daftar Berita</a></li>
        <li class="admin_fitur"><a href="{{ route('memberships.index') }}">Daftar Membership</a></li>
        <li class="admin_fitur"><a href="{{ route('products.index') }}">Daftar Produk</a></li>
        <li class="admin_fitur"><a href="{{ route('reviews.index') }}">Daftar Review</a></li>
        <li class="admin_fitur"><a href="{{ route('transactions.admin_index') }}">Daftar Transaksi</a></li>
        <li class="admin_fitur"><a href="{{ route('vouchers.index') }}">Daftar Voucher</a></li>
        <li class="admin_fitur"><a href="{{ route('favorites.index') }}">Daftar Favorit</a></li>
    </ul>
</body>
</html>