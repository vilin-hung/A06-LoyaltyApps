<!DOCTYPE html>
<html>
<head>
    <title>Daftar</title>
</head>
<body>
    <h1>Daftar Akun</h1>
    
    <!-- Alert Success -->
    @if(session('success'))
        <p style="color: green;"><b>{{ session('success') }}</b></p>
    @endif
    
    <!-- Alert Error -->
    @error('email')
        <p style="color: red;"><b>{{ $message }}</b></p>
    @enderror
    @error('name')
        <p style="color: red;"><b>{{ $message }}</b></p>
    @enderror
    @error('password')
        <p style="color: red;"><b>{{ $message }}</b></p>
    @enderror
    
    <form method="POST" action="{{ route('signup.submit') }}">
        @csrf
        
        <label>Nama:</label><br>
        <input type="text" name="name" value="{{ old('name') }}" required><br><br>
        
        <label>Email:</label><br>
        <input type="email" name="email" value="{{ old('email') }}" required><br><br>
        
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        
        <label>Konfirmasi Password:</label><br>
        <input type="password" name="password_confirmation" required><br><br>
        
        <button type="submit">Daftar</button>
    </form>
    
    <p>Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
</body>
</html>