<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <style>
        body { margin: 20px; color: #333;}
        
        /* Style untuk navigasi */
        .nav { margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid #ccc; }
        .nav_link { text-decoration: none; color: #4545a5; margin-right: 15px; font-weight: bold; }
        
        /* Box info user */
        .user_info { padding: 15px; border: 1px solid; border-radius: 4px; margin-bottom: 20px; }

        /* Warna Membership */
        .color_silver { color: #8e8e8e; font-weight: bold; }
        .color_gold { color: #d4af37; font-weight: bold; }
        .color_platinum { color: #504d49; font-weight: bold; }
        
        /* List Fitur */
        .fitur { list-style-type: none; padding: 0; margin: 0; }
        .fitur_item { padding: 10px 0; }
        .fitur_item a { text-decoration: none; color: #333; font-weight: bold; }
        .fitur_item a:hover { color: #4545a5; }
    </style>
</head>
<body>

    <nav class="nav">
        <a href="{{ route('home') }}" class="nav_link">Beranda</a>
        <a href="{{ route('profile') }}" class="nav_link">Profil</a>
        <a href="{{ route('points') }}" class="nav_link">Poin</a>
        <a href="{{ route('saldo') }}" class="nav_link">Saldo</a>
        <a href="{{ route('membership.info') }}" class="nav_link">Membership</a>
        <a href="{{ route('logout') }}" class="nav_link" style="color: #cb4335;">Keluar</a>
    </nav>

    <!-- Success -->
    @if(session('success'))
        <p style="color: green;"><b>{{ session('success') }}</b></p>
    @endif

    <div class="user_info">
        <h1>Halo, {{ auth()->user()->name }}</h1>
        <p>
            Poin: {{ auth()->user()->points }} 
            &nbsp;
            Saldo: Rp {{ number_format(auth()->user()->saldo, 0, ',', '.') }} 
            &nbsp;
            Membership: 
            <span class="color_{{ strtolower(auth()->user()->membership->level ?? 'silver') }}">
                {{ auth()->user()->membership->level ?? 'Silver' }}
            </span>
        </p>
    </div>

    <h3 style="color: #4545a5;">Fitur</h3>
    <ul class="fitur">
        <li class="fitur_item"><a href="/products">Produk</a></li>
        <li class="fitur_item"><a href="/favorites">Produk Favorit</a></li>
        <li class="fitur_item"><a href="/carts">Keranjang</a></li>
        <li class="fitur_item"><a href="/transactions">Riwayat Transaksi</a></li>
        <li class="fitur_item"><a href="/redeems/create">Tukar Poin</a></li>
        <li class="fitur_item"><a href="/redeems">Riwayat Redeem</a></li>
        <li class="fitur_item"><a href="/vouchers">Daftar Voucher</a></li>
        <li class="fitur_item"><a href="/news">Berita</a></li>
    </ul>
</body>
</html>