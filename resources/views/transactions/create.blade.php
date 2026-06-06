<!DOCTYPE html>
<head>
    <title>Checkout Pesanan</title>
</head>
<body>

<h2>Checkout Pesanan (Order Now)</h2>

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
            <option value="{{ $voucher->id }}">{{ $voucher->code }} (Potongan: Rp {{ $voucher->discount_value }})</option>
        @endforeach
    </select>

    <br><br>
    <button type="submit">Buat Pesanan Sekarang</button>
</form>

</body>
</html>