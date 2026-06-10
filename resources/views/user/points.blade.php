<!DOCTYPE html>
<html>
<head>
    <title>Poin</title>
</head>
<body>
    <nav>
        <a href="{{ route('home') }}">Beranda</a> |
        <a href="{{ route('profile') }}">Profil</a> |
        <a href="{{ route('points') }}">Poin</a> |
        <a href="{{ route('saldo') }}">Saldo</a> |
        <a href="{{ route('membership.info') }}">Membership</a> |
        <a href="{{ route('logout') }}">Keluar</a>
    </nav>
    
    <h1>Poin Saya</h1>
    
    <h2>{{ $user->points }} Poin</h2>
</body>
</html>