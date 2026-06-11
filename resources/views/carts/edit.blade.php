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
                max="{{ $cart->product->stock }}"
            >
        </p>

        <p>
            <button style="background: #4545a5; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
                type="submit">
                Simpan Perubahan
            </button>
            <button style="background: #981e11; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
                type="submit"
                onclick="window.location='{{ route('carts.index') }}'">
                Batal
            </button>
        </p>
    </form>

</body>
</html>