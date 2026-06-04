<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    
    <!-- Alert Success -->
    @if(session('success'))
        <p style="color: green;"><b>{{ session('success') }}</b></p>
    @endif
    
    <!-- Alert Error -->
    @error('email')
        <p style="color: red;"><b>{{ $message }}</b></p>
    @enderror
    
    <form method="POST" action="{{ route('login.submit') }}">
        @csrf
        
        <label>Email:</label><br>
        <input type="email" name="email" value="{{ old('email') }}" required><br><br>
        
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        
        <button type="submit">Masuk</button>
    </form>
    
    <p>Belum punya akun? <a href="{{ route('signup') }}">Daftar</a></p>
</body>
</html>