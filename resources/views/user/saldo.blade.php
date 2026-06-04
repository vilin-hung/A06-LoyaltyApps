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
</body>
</html>