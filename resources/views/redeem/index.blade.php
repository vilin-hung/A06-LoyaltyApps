<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Redeem</title>
    <style>
        body { margin: 20px; color: #333; }
        .btn { padding: 8px 16px; border: none; border-radius: 6px; cursor: pointer; text-decoration: none; display: inline-block; font-size: 14px; }
        .btn_blue { background: #4545a5; color: #fff6fd; }
        .btn_green { background: #7b9e87; color: #fff6fd; }
        .table { border-collapse: collapse; width: 100%;}
        .table th, .table td { padding: 10px; border: 1px solid #ccc; }
        .table th { background-color: #f3f4f6; }
    </style>
</head>
<body>

    <h1>Riwayat Redeem</h1>

    <p>
        <a href="{{ route('home') }}" class="btn btn_blue">Kembali ke Beranda</a>
        &nbsp;&nbsp;
        <a href="{{ route('redeems.create') }}" class="btn btn_green">Tukar Voucher Lagi</a>
    </p>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Voucher</th>
                <th>Poin</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($redeems as $redeem)
            <tr style="text-align:center">
                <td>{{ $redeem->id }}</td>
                <td style="text-align: left;">{{ $redeem->voucher->name }}</td>
                <td>{{ $redeem->points_spent }}</td>
                <td>
                    {{ $redeem->status === 'used' ? 'Sudah Dipakai' : 'Belum Dipakai' }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" style="text-align:center">Belum ada riwayat penukaran.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>