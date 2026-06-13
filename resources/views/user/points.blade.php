<!DOCTYPE html>
<html>
<head>
    <title>Poin</title>
    <style>
        body { margin: 20px; color: #333; }
        
        /* Navigasi */
        .nav { margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid #ccc; }
        .nav_link { text-decoration: none; color: #4545a5; margin-right: 15px; font-weight: bold; }
        
        /* Box & Form */
        .card { padding: 15px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 20px; }
        
        /* Tombol */
        .btn { padding: 8px 16px; border: none; border-radius: 6px; cursor: pointer; text-decoration: none; display: inline-block; font-size: 14px; }
        .btn_green { background: #7b9e87; color: #fff6fd;}
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

    <div class="card">
        <h1>Poin Saya</h1>
        <h2>{{ $user->points }} Poin</h2>


        <!-- Redirect ke reedem buat tukar poin -->
        <form method="GET" action="{{ route('redeem.create') }}">
            <button type="submit" class="btn btn_green">Tukar Poin Sekarang</button>
        </form>
    </div>
</body>
</html>