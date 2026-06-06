<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Transaksi</title>
</head>
<body>

    <h1>Riwayat Transaksiku</h1>
    
    <p>
        <a href="{{ route('carts.index') }}">Kembali ke Keranjang</a> | 
        <a href="{{ route('products.index') }}">Ke Daftar Produk</a>
    </p>

    @if(session('success'))
        <p style="color: green;"><strong>{{ session('success') }}</strong></p>
    @endif

    @if($transactions->isEmpty())
        <p>Kamu belum pernah melakukan transaksi apapun.</p>
    @endif

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f3f4f6;">
                <th>ID Transaksi</th>
                <th>Tanggal & Waktu</th>
                <th>Total Pembayaran</th>
                <th>Poin yang Didapat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $trx)
                <tr>
                    <td>#{{ $trx->id }}</td>
                    <td>{{ $trx->created_at->format('d M Y, H:i') }}</td>
                    <td>Rp {{ number_format($trx->total_amount, 0, ',', '.') }}</td>
                    <td style="color: green; font-weight: bold;">+{{ $trx->points_earned }} Poin</td>
                    <td>
                        <a href="{{ route('transactions.show', $trx->id) }}">Detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>