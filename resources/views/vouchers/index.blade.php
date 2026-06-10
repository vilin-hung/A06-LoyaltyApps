<!DOCTYPE html>
<html>
<head>
    <title>Vouchers</title>
</head>
<body style="margin: 20px; color: #333;">

    <h1>Daftar Voucher</h1>
    
    <p>
        @if(Auth::check() && auth()->user()->role === 'admin')
            <form action="{{ route('admin.dashboard') }}" style="display:inline;">
                <button style="background: #4545a5; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;" type="submit">
                    Kembali ke Beranda Admin
                </button>
            </form>
            &nbsp;&nbsp;
            <form action="{{ route('vouchers.create') }}" style="display:inline;">
                <button style="background: #7b9e87; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;" type="submit">
                    Tambah Voucher
                </button>
            </form>
        @else
            <form action="{{ route('home') }}" style="display:inline;">
                <button style="background: #4545a5; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;" type="submit">
                    Kembali ke Beranda
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
                <th>Nama</th>
                <th>Kode</th>
                <th>Diskon</th>
                <th>Poin Dibutuhkan</th>
                <th>Kuota</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vouchers as $voucher)
                <tr style="text-align:center">
                    <td style="font-weight: bold; text-align: left;">{{ $voucher->name }}</td>
                    <td>
                        <span style="background-color: #e8f8f5; color: #117a65; padding: 2px 6px; border-radius: 4px; font-weight: bold;">
                            {{ $voucher->code }}
                        </span>
                    </td>
                    <td>
                        @if($voucher->discount_type == 'percentage')
                            {{ $voucher->discount_value }}%
                        @else
                            Rp {{ number_format($voucher->discount_value, 0, ',', '.') }}
                        @endif
                    </td>
                    <td>{{ $voucher->points_required }} Poin</td>
                    <td>{{ $voucher->quota }}</td>
                    <td>
                        @if($voucher->is_active)
                            <span style="color: green; font-weight: bold;">Aktif</span>
                        @else
                            <span style="color: red; font-weight: bold;">Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <button style="background: #7b9e87; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
                            type="button"
                            onclick="window.location='{{ route('vouchers.show', $voucher->id) }}'">
                            Detail Voucher
                        </button>

                        @if(Auth::check() && auth()->user()->role !== 'admin')
                            <form action="{{ route('redeem.store') }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="voucher_id" value="{{ $voucher->id }}">
                                <button style="background: #7b9e87; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;" 
                                    type="submit" {{ ($voucher->quota <= 0 || !$voucher->is_active) ? 'disabled' : '' }}>
                                    Tukarkan
                                </button>
                            </form> 
                        @endif 

                        @if(Auth::check() && auth()->user()->role === 'admin')
                            <button style="background: #7b9e87; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
                                type="button"
                                onclick="window.location='{{ route('vouchers.edit', $voucher->id) }}'">
                                Ubah
                            </button>

                            <form action="{{ route('vouchers.destroy', $voucher->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button style="background: #cb4335; color: white; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
                                    type="submit" 
                                    onclick="return confirm('Hapus voucher ini?')">
                                    Hapus
                                </button>
                            </form> @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>