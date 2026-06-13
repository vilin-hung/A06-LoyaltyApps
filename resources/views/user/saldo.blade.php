<!DOCTYPE html>
<html>
<head>
    <title>Saldo</title>
    <style>
        body { margin: 20px; color: #333; }
        
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

    <div class="card">
        <h1>Saldo Saya</h1>
        <h2>Rp {{ number_format($user->saldo, 0, ',', '.') }}</h2>
    </div>
    
    <div class="card">
        <h1>Top Up</h1>
        
        <!-- Notifikasi setelah top up -->
        <!-- Success -->
        @if(session('success'))
            <p style="color: green;"> {{ session('success') }}</p>
        @endif
        
        <!-- Error -->
        @if(session('error'))
            <p style="color: red;"> {{ session('error') }}</p>
        @endif
        
        <!-- Validation Error -->
        @error('amount')
            <p style="color: red;"> {{ $message }}</p>
        @enderror
        
        <form method="POST" action="{{ route('saldo.topup') }}">
            @csrf
             <!-- Pilihan nominal top up saldo -->
            <select name="amount" required>
                <option value="">Pilih Nominal</option>
                <option value="50000">50.000</option>
                <option value="100000">100.000</option>
                <option value="200000">200.000</option>
                <option value="500000">500.000</option>
            </select>
            <br><br>
            <button type="submit" class="btn btn_green">Top Up</button>
        </form>
    </div>
</body>
</html>