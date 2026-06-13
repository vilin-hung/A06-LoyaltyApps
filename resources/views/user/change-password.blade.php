<!DOCTYPE html>
<html>
<head>
    <title>Ubah Password</title>
    <style>
        body { margin: 20px; color: #333; }
        
        /* Box & Form */
        .card { padding: 20px; border: 1px solid #ccc; border-radius: 4px; width: 50%; }
        
        /* Tombol */
        .btn { padding: 8px 16px; border: none; border-radius: 6px; cursor: pointer; text-decoration: none; display: inline-block; font-size: 14px; }
        .btn_green { background: #7b9e87; color: #fff6fd; }
        .btn_blue { background: #4545a5; color: #fff6fd; }
    </style>
</head>
<body>

    <div class="card">
        <h1>Ubah Password</h1>
        
        <!-- Error Password Lama -->
        @error('old_password')
            <p style="color: red;"> {{ $message }}</p>
        @enderror
        
        <!-- Error Password Baru -->
        @error('new_password')
            <p style="color: red;"> {{ $message }}</p>
        @enderror
        
        <!-- Error Konfirmasi -->
        @error('new_password_confirmation')
            <p style="color: red;"> {{ $message }}</p>
        @enderror
        
        <form method="POST" action="{{ route('change-password.submit') }}">
            @csrf
            
            <p>
                <label>Password Lama:</label><br>
                <input type="password" name="old_password" required>
            </p>
            
            <p>
                <label>Password Baru:</label><br>
                <input type="password" name="new_password" required>
            </p>
            
            <p>
                <label>Konfirmasi Password:</label><br>
                <input type="password" name="new_password_confirmation" required>
            </p>
            
            <button type="submit" class="btn btn_green">Simpan</button>
        </form>
        
        <br>
        <a href="{{ route('profile') }}" class="btn btn_blue">Kembali ke Profil</a>
    </div>
</body>
</html>