<!DOCTYPE html>
<html>
<head>
    <title>Memberships</title>
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

<!-- Halaman daftar all tier membership -->
<h1>Daftar Tier Membership</h1>

<p>
    <a href="{{ route('admin.dashboard') }}" class="btn">
        Kembali ke Dashboard
    </a>
    
    @if(Auth::check() && auth()->user()->is_admin)
        <!-- Button 'tambah tier membership' hanya untuk admin -->
        &nbsp;&nbsp;<a href="{{ route('memberships.create') }}" class="btn">
            Tambah Tier Membership
        </a>
    @endif
</p>

@if(session('success'))
    <p style="color: green;"><b>{{ session('success') }}</b></p>
@endif
<br>

<table border="1" cellpadding="10">
    <tr>
        <th>Level</th>
        <th>Min. Transaksi</th>
        <th>Pengganda Poin</th>
        <th>Diskon Otomatis</th>
        <th>Aksi</th>
    </tr>

    @foreach($memberships as $membership)
    <tr>
        <td><strong>{{ $membership->level }}</strong></td>
        <td>Rp {{ number_format($membership->min_transaction, 0, ',', '.') }}</td>
        <td>x{{ $membership->point_multiplier }}</td>
        <td>{{ $membership->discount_percentage }}%</td>
        
        <td>
            <!-- Button detail membership (bisa diakses semua user) -->
            <a href="{{ route('memberships.show', $membership->id) }}" class="btn">
                Detail Membership
            </a>
            
            <!-- Button edit dan delete membership (admin only) -->
            @if(Auth::check() && auth()->user()->is_admin)
                <a href="{{ route('memberships.edit', $membership->id) }}" class="btn">
                    Edit
                </a>
                <form action="{{ route('memberships.destroy', $membership->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn" onclick="return confirm('Hapus tier ini?')">
                        Delete
                    </button>
                </form>
            @endif
        </td>
    </tr>
    @endforeach
</table>
</body>
</html>