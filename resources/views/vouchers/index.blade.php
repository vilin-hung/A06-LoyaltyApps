<!DOCTYPE html>
<html>
<head>
    <title>Vouchers</title>
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

<!-- Halaman daftar all voucher -->
<h1>Daftar Voucher</h1>
<p>
    <a href="{{ route('home') }}" class="btn">
        Kembali ke Beranda
    </a>
</p>

@if(Auth::check() && auth()->user()->is_admin)
    <p>
        <a href="{{ route('admin.dashboard') }}" class="btn">
            Kembali ke Dashboard
        </a>
        <!-- Button 'tambah voucher' hanya untuk admin -->
        &nbsp;&nbsp;<a href="{{ route('vouchers.create') }}" class="btn">
            Tambah Voucher
        </a>
    </p>
@endif

@if(session('success'))
    <p style="color: green;"><b>{{ session('success') }}</b></p>
@endif
<br>

<table border="1" cellpadding="10">
    <tr>
        <th>Nama</th>
        <th>Kode</th>
        <th>Diskon</th>
        <th>Poin Dibutuhkan</th>
        <th>Kuota</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($vouchers as $voucher)
    <tr>
        <!-- Menampilkan detail voucher -->
        <td>{{ $voucher->name }}</td>
        <td>{{ $voucher->code }}</td>
        <td>
            @if($voucher->discount_type == 'percentage')
                {{ $voucher->discount_value }}%
            @else
                Rp {{ number_format($voucher->discount_value, 0, ',', '.') }}
            @endif
        </td>
        <td>{{ $voucher->points_required }}</td>
        <td>{{ $voucher->quota }}</td>
        
        <td>
            @if($voucher->is_active)
                Aktif
            @else
                Nonaktif
            @endif
        </td>
        
        <td>
            <!-- Button detail voucher (bisa diakses semua user) -->
            <a href="{{ route('vouchers.show', $voucher->id) }}" class="btn">
                Detail Voucher
            </a>

            @if(Auth::check() && !auth()->user()->is_admin)
                <form action="{{ route('redeem.store') }}" method="POST" style="display:inline;">
                    @csrf
                    <input type="hidden" name="voucher_id" value="{{ $voucher->id }}">
                    <!-- Button 'tukar voucher' hanya untuk user -->
                    <button type="submit" class="btn" {{ ($voucher->quota <= 0 || !$voucher->is_active) ? 'disabled' : '' }}>
                        Tukarkan
                    </button>
                </form> 
            @endif 
            
            @if(Auth::check() && auth()->user()->is_admin)
                <!-- Button 'edit voucher' dan 'hapus voucher' hanya untuk admin -->
                <a href="{{ route('vouchers.edit', $voucher->id) }}" class="btn">
                    Edit
                </a>
                <form action="{{ route('vouchers.destroy', $voucher->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn" onclick="return confirm('Hapus voucher ini?')">
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