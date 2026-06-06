<!DOCTYPE html>
<html>
<head>
    <title>Ubah Password</title>
</head>
<body>
    <nav>
        <a href="{{ route('home') }}">Beranda</a> |
        <a href="{{ route('profile') }}">Profil</a> |
        <a href="{{ route('points') }}">Poin</a> |
        <a href="{{ route('saldo') }}">Saldo</a> |
        <a href="{{ route('logout') }}">Keluar</a>
    </nav>
    
    <h1>Ubah Password</h1>
    
    <!-- Alert Success -->
    @if(session('success'))
        <p style="color: green;"><b>{{ session('success') }}</b></p>
    @endif
    
    <!-- Alert Error -->
    @error('old_password')
        <p style="color: red;"><b>{{ $message }}</b></p>
    @enderror
    
    <form method="POST" action="{{ route('change-password.submit') }}">
        @csrf
        
        <label>Password Lama:</label><br>
        <input type="password" name="old_password" required><br><br>
        
        <label>Password Baru:</label><br>
        <input type="password" name="new_password" required><br><br>
        
        <label>Konfirmasi Password:</label><br>
        <input type="password" name="new_password_confirmation" required><br><br>
        
        <button type="submit">Simpan</button>
    </form>
</body>
</html>