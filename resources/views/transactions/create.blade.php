<!DOCTYPE html>
<head>
    <title>Checkout Pesanan</title>
</head>
<body>

<h2>Checkout Pesanan</h2>

<form action="{{ route('transactions.store') }}" method="POST">
    @csrf

    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <input type="hidden" name="quantity" value="{{ $quantity }}">

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>{{ $product->name }}</strong></td>
                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                <td>{{ $quantity }}</td>
                <td>Rp {{ number_format($product->price * $quantity, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Opsi Pembayaran & Voucher</h3>
    <label>Pilih Voucher Terbuka:</label>
    <select name="voucher_id">
        <option value="">-- Tanpa Voucher --</option>
        @foreach($vouchers as $voucher)
            <option value="{{ $voucher->id }}">
                {{ $voucher->code }}
                (Potongan: 
                @if($voucher->type === 'percentage')
                   {{ $voucher->discount_value }}% 
                @else
                    Rp {{ $voucher->discount_value }}
                @endif
                )
            </option>
        @endforeach
    </select>

    <div>
        <p>Subtotal: <strong>Rp {{ number_format($subtotalChosen ?? 0, 0, ',', '.') }}</strong></p>

        @if(($membershipDiscount ?? 0) > 0)
            <p>Diskon Membership: <strong>-Rp {{ number_format($membershipDiscount ?? 0, 0, ',', '.') }}</strong></p>
        @endif

        <p>Diskon Voucher: <strong>-Rp {{ number_format($voucherDiscount ?? 0, 0, ',', '.') }}</strong></p>
        <br>
        <h3>Total Akhir: Rp {{ number_format($totalFinal ?? 0, 0, ',', '.') }}</h3>
    </div> 

    <br><br>
    <button type="submit">Buat Pesanan Sekarang</button>
    <br><br>

    <p>Tidak jadi belanja?
        <a href="{{ route('products.index') }}">Lihat Daftar Produk</a>
        <a> | </a>
        <a href="{{ route('home') }}">Kembali Ke Beranda</a>
    </p>    
</form>
    <p>Ingin mengubah jumlah pesanan?</p>
    <form action="{{ route('carts.store') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <input type="hidden" name="quantity" value="{{ $quantity }}">
        <input type="hidden" name="redirect_to_cart" value="1">
    
        <button type="submit">
            Simpan ke Keranjang & Ubah Jumlah
        </button>
    </form>
    

</body>
</html>