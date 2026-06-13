<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pengguna</title>
   <style>
        body { margin: 20px; color: #333; }
        .btn { padding: 8px 16px; border: none; border-radius: 6px; cursor: pointer; text-decoration: none; display: inline-block; font-size: 14px; }
        .btn_blue { background: #4545a5; color: #fff6fd; }
        .table { border-collapse: collapse; width: 100%; }
        .table th, .table td { padding: 10px; border: 1px solid #ccc; }
        .table th { background-color: #f3f4f6; }
    </style>
</head>
<body>
    <h1>Daftar Pengguna</h1>
    
    <p>
        <a href="{{ route('admin.dashboard') }}" class="btn btn_blue">
            Kembali ke Beranda Admin
        </a>
    </p>
    
    <!-- Menampilkan seluruh daftar pengguna -->
    <table class="table">
        <thead>    
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Tier</th>
            </tr>
        </thead>
        <tbody>
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
        </tbody>
        
    </table>
</body>
</html>