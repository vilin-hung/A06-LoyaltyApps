<html>
<head>
    <title>Ubah Jumlah Item</title>
</head>
<body>

    <h1>Ubah Jumlah Produk</h1>
    <p>Produk yang diubah: <strong>{{ $cart->product->name }}</strong></p>

    <form action="{{ route('carts.update', $cart->id) }}" method="POST">
        @csrf
        @method('PUT')

        <p>
            <label for="quantity">Jumlah Baru:</label><br>
            <input
                type="number"
                name="quantity"
                id="quantity"
                value="{{ $cart->quantity }}"
                min="1" required
                max="{{ $product->stock }}"
            >
        </p>

        <p>
            <button type="submit">Simpan Perubahan</button>
            <a href="{{ route('carts.index') }}">Batal</a>
        </p>
    </form>

</body>
</html>