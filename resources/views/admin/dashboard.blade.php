<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
</head>
<body>
    <nav>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a> |
        <a href="{{ route('logout') }}">Keluar</a>
    </nav>
    
    <h1>Dashboard Admin</h1>
    
    <ul>
        <li><a href="{{ route('products.index') }}">Daftar Produk</a></li>
        <li><a href="{{ route('reviews.index') }}">Daftar Review</a></li>
        <li><a href="{{ route('vouchers.index') }}">Daftar Voucher</a></li>
        <li><a href="{{ route('memberships.index') }}">Daftar Membership</a></li>
        <li><a href="{{ route('news.index') }}">Daftar Berita</a></li>
    </ul>
</body>
</html>