<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <nav>
        <a href="{{ route('home') }}">Beranda</a> |
        <a href="{{ route('profile') }}">Profil</a> |
        <a href="{{ route('points') }}">Poin</a> |
        <a href="{{ route('saldo') }}">Saldo</a> |
        <a href="{{ route('membership.info') }}">Membership</a> | <a href="{{ route('logout') }}">Keluar</a>

    </nav>
    
    <!-- Alert -->
    @if(session('success'))
        <p style="color: green;"><b>{{ session('success') }}</b></p>
    @endif
    
    <h1>Halo, {{ auth()->user()->name }}</h1>
    
    <h2>Poin: {{ auth()->user()->points }}</h2>
    <h2>Saldo: Rp {{ number_format(auth()->user()->saldo, 0, ',', '.') }}</h2>
    <h2>Membership: {{ auth()->user()->membership->level ?? 'Silver' }}</h2>
    
    <a href="{{ route('vouchers.index') }}" class="btn btn-primary">
        Lihat Daftar Voucher
    </a>
    
    <h3>Fitur:</h3>
    <ul>
        <li><a href="/products">Produk</a></li>
        <li><a href="/carts">Keranjang</a></li>
        <li><a href="/transactions">Riwayat Transaksi</a></li>
        <li><a href="/redeem">Tukar Poin</a></li>
        <li><a href="/vouchers">Voucher Saya</a></li>
        <li><a href="/news">Berita</a></li>
        <li><a href="{{ route('redeem.history') }}">Voucher Saya</a></li>
    </ul>
</body>
</html>