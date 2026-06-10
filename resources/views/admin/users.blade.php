<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pengguna</title>
    <style>
        .btn {
            padding: 5px 10px;
            text-decoration: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f2f2f2;
            color: black;
            font-size: 14px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Daftar Pengguna</h1>
    
    <p>
        <a href="{{ route('admin.dashboard') }}" class="btn">Kembali ke Beranda Admin</a>
    </p>
    <br>
    
    <!-- Menampilkan seluruh daftar pengguna -->
    <table border="1" cellpadding="10">
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Tier</th>
        </tr>
        
        @forelse($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->membership->level ?? '-' }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="5">Belum ada pelanggan.</td>
        </tr>
        @endforelse
    </table>
</body>
</html>