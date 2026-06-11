<!DOCTYPE html>
<html>
<head>
    <title>Memberships</title>
</head>
<body style="margin: 20px; color: #333;">

    <h1>Daftar Tier Membership</h1>

    <p>
        <form action="{{ route('admin.dashboard') }}" style="display:inline;">
            <button style="background: #4545a5; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;" type="submit">
                Kembali ke Beranda Admin
            </button>
        </form>
        
        @if(Auth::check() && auth()->user()->role === 'admin')
            &nbsp;&nbsp;
            <form action="{{ route('memberships.create') }}" style="display:inline;">
                <button style="background: #7b9e87; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;" type="submit">
                    Tambah Tier Membership
                </button>
            </form>
        @endif
    </p>

    @if(session('success'))
        <p style="color: green;"><b>{{ session('success') }}</b></p>
    @endif
    <br>

    <table border="1" cellpadding="10" cellspacing="0" style="border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f3f4f6;">
                <th>Level</th>
                <th>Min. Transaksi</th>
                <th>Pengganda Poin</th>
                <th>Diskon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($memberships as $membership)
                <tr style="text-align:center">
                    <td style="font-weight: bold; text-align: left;">
                        <span style="background-color: #e8f8f5; color: #117a65; padding: 4px 8px; border-radius: 4px;">
                            {{ $membership->level }}
                        </span>
                    </td>
                    <td>Rp {{ number_format($membership->min_transaction, 0, ',', '.') }}</td>
                    <td style="color: green; font-weight: bold;">x{{ $membership->point_multiplier }}</td>
                    <td>{{ $membership->discount_percentage }}%</td>
                    <td>
                        <button style="background: #7b9e87; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
                            type="button"
                            onclick="window.location='{{ route('memberships.show', $membership->id) }}'">
                            Detail Membership
                        </button>

                        @if(Auth::check() && auth()->user()->role === 'admin')
                            <button style="background: #7b9e87; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
                                type="button"
                                onclick="window.location='{{ route('memberships.edit', $membership->id) }}'">
                                Ubah
                            </button>

                            <form action="{{ route('memberships.destroy', $membership->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button style="background: #cb4335; color: white; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
                                    type="submit" 
                                    onclick="return confirm('Hapus tier ini?')">
                                    Hapus
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>