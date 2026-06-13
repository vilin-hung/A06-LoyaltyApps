<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body { margin: 20px; color: #333;}
        
        /* Box */
        .card { padding: 20px; border: 1px solid #ccc; text-align: center; border-radius: 4px; width: 100%; max-width: 400px; }
        
        /* Tombol */
        .btn { padding: 8px 16px; border: none; border-radius: 6px; cursor: pointer; text-decoration: none; display: inline-block; font-size: 14px; }
        .btn_green { background: #7b9e87; color: #fff6fd;}
        .link { color: #4545a5; text-decoration: none; }
    </style>
</head>
<body>
    <div style="display: flex; justify-content: center; align-items: center; min-height: 500px;">
        <div class="card">
            <h1>Login</h1>
            
            <!-- Notif Success -->
            @if(session('success'))
                <p style="color: green; font-weight: bold;"> {{ session('success') }}</p>
            @endif
            
            <!-- Alert Error -->
            @error('email')
                <p style="color: red;"> {{ $message }}</p>
            @enderror

            <!-- Form login -->
            <form method="POST" action="{{ route('login.submit') }}">
                @csrf
                
                <p>
                    <label>Email:</label><br>
                    <input type="email" name="email" value="{{ old('email') }}" required>
                </p>
                
                <p>
                    <label>Password:</label><br>
                    <input type="password" name="password" required>
                </p>
                
                <button type="submit" class="btn btn_green">Masuk</button>
            </form>
            
            <!-- Redirect ke signup page -->
            <p>Belum punya akun? <a href="{{ route('signup') }}" class="link">Daftar</a></p>
        </div>
    </div>
</body>
</html>