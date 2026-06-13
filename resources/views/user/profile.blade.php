<!DOCTYPE html>
<html>
<head>
    <title>Profil</title>
    <style>
        body { margin: 20px; color: #333;}
        
        /* Navigasi */
        .nav { margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid #ccc; }
        .nav_link { text-decoration: none; color: #4545a5; margin-right: 15px; font-weight: bold; }
        
        /* Box & Form */
        .card { padding: 15px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 20px; }
        
        /* Tombol */
        .btn { padding: 8px 16px; border: none; border-radius: 6px; cursor: pointer; text-decoration: none; display: inline-block; font-size: 14px; }
        .btn_green { background: #7b9e87; color: #fff6fd; }
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
    
    <h1>Profil</h1>
    
    <!-- Notifikasi Success -->
    @if(session('success'))
        <p style="color: green; font-weight: bold; margin-bottom: 15px;"> {{ session('success') }}</p>
    @endif
    
    <div class="card">
        <h3>Data Diri</h3>
        <p><strong>Nama:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
    </div>
    
    <div class="card">
        <h3>Mau Ubah Password?</h3>
        <!-- Redirect ke change password -->
        <a href="{{ route('change-password') }}" class="btn btn_green">Ubah</a>
    </div>
</body>
</html>