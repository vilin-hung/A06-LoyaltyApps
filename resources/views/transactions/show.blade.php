<!DOCTYPE html>
<head>
    <title>Transaksi Berhasil</title>
</head>
<body>

<div>
    <h2 style="color: green;">Pesanan Berhasil Dibuat!</h2>
    
    @if(session('success'))
        <p><strong>Status:</strong> {{ session('success') }}</p>
    @endif

    @if(auth()->user()->role === 'user')
        <fieldset>
            <legend>Informasi Reward Anda</legend>
            <p>Selamat! Dari transaksi ini, Anda berhasil mendapatkan tambahan:</p>
            <h3>+ {{ $transaction->points_earned ?? 0 }} Poin</h3>
            <small>*Poin telah otomatis ditambahkan ke akun Anda dan bisa ditukarkan dengan voucher baru.</small>
        </fieldset>
    @endif

    @if(auth()->user()->role === 'admin')
        <p>Dari transaksi ini, user mendapatkan + {{ $transaction->points_earned ?? 0 }} Poin</p>
    @endif
    <br>

    <h3>Nota Transaksi (ID: # {{ $transaction->id }})</h3>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaction->transactionItems as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp {{ number_format($item->product->price, 0, ',', '.') }}</td>
                </tr>
            @endforeach

        <tr>
            <td colspan="2"><strong>Subtotal:</strong></td>
            <td>Rp {{ number_format($transaction->total_amount + ($transaction->membership_discount ?? 0) + ($transaction->voucher_discount ?? 0), 0, ',', '.') }}</td>
        </tr>

        @if($transaction->membership_discount > 0)
            <tr>
                <td colspan="2" style="color: #e74c3c;"><strong>Diskon Member:</strong></td>
                <td>- Rp {{ number_format($transaction->membership_discount, 0, ',', '.') }}</td>
            </tr>
        @endif

        @if($transaction->voucher_discount > 0)
            <tr>
                <td colspan="2" style="color: #e74c3c;"><strong>Diskon Voucher:</strong></td>
                <td>- Rp {{ number_format($transaction->voucher_discount, 0, ',', '.') }}</td>
            </tr>
        @endif

        <tr>
            <td colspan="2"><strong>Total Akhir:</strong></td>
            <td><strong>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</strong></td>
        </tr>
        </tbody>
    </table>

    <br><br>
    
    <p>
        @if(auth()->user()->role === 'user')
            <form action="{{ route('transactions.index') }}">
            <button type="submit">Lihat Transaksi Lainnya</button>
            </form>
            <br>

            <form action="{{ route('carts.index') }}">
            <button type="submit">Intip Keranjangku</button>
            </form>
            <br>

            <form action="{{ route('products.index') }}">
            <button type="submit">Lihat Daftar Produk</button>
            </form>
            <br>
        @endif

        @if(auth()->user()->role === 'admin')
            <form action="{{ route('transactions.admin_index') }}">
            <button type="submit">Lihat Transaksi Lainnya</button>
            </form>
            <br>
        @endif

        <form action="{{ route('home') }}">
          <button type="submit">Kembali ke Beranda</button>
        </form>
    </p>

</div>

</body>
</html>