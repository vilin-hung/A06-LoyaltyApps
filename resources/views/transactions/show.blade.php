<!DOCTYPE html>
<head>
    <title>Detail Transaksi</title>
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
                <td colspan="2" style="color: #2d6601;"><strong>Diskon Member:</strong></td>
                <td>- Rp {{ number_format($transaction->membership_discount, 0, ',', '.') }}</td>
            </tr>
        @endif

        @if($transaction->voucher_discount > 0)
            <tr>
                <td colspan="2" style="color: #2d6601;"><strong>Diskon Voucher:</strong></td>
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
                <button style="background: #7b9e87; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
                    type="submit">
                    Lihat Transaksi Lainnya
                </button>
            </form>
            <br>

            <form action="{{ route('carts.index') }}">
                <button style="background: #7b9e87; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
                    type="submit">
                    Intip Keranjangku
                </button>
            </form>
            <br>

            <form action="{{ route('products.index') }}">
                <button style="background: #7b9e87; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
                    type="submit">
                    Lihat Daftar Produk
                </button>
            </form>
            <br>

            <form action="{{ route('home') }}">
                <button style="background: #4545a5; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
                    type="submit">
                    Kembali ke Beranda
                </button>
            </form>        
        @endif

        @if(auth()->user()->role === 'admin')
            <form action="{{ route('transactions.admin_index') }}">
                <button style="background: #7b9e87; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
                    type="submit">
                    Lihat Transaksi Lainnya
                </button>
            </form>
            <br>

            <form action="{{ route('admin.dashboard') }}">
                <button style="background: #4545a5; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
                    type="submit">
                    Kembali ke Beranda Admin
                </button>
            </form>   
        @endif
    </p>

</div>

</body>
</html>