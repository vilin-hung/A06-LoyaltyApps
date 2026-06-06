<!DOCTYPE html>
<html>
<head>
    <title>Saldo</title>
</head>
<body>
    <nav>
        <a href="{{ route('home') }}">Beranda</a> |
        <a href="{{ route('profile') }}">Profil</a> |
        <a href="{{ route('points') }}">Poin</a> |
        <a href="{{ route('saldo') }}">Saldo</a> |
        <a href="{{ route('logout') }}">Keluar</a>
    </nav>
    
    <h1>Saldo Saya</h1>
    <h2>Rp {{ number_format($user->saldo, 0, ',', '.') }}</h2>
    <hr>
    
    <h2>Top Up</h2>
    
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
        
        <button type="submit">Top Up</button>
    </form>
</body>
</html>