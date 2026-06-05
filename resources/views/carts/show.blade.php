<!DOCTYPE html>
<html>
<head>
  <title>Detail Item Keranjang</title>
</head>
<body>

  <h1>Detail Item Keranjang</h1>
  
  <p>
    <a href="{{ route('carts.index') }}">Kembali ke Keranjang</a>
  </p>

  <hr>

  <p><strong>Nama Produk:</strong> {{ $cart->product->name }}</p>
  <p><strong>Harga Per Item:</strong> Rp {{ number_format($cart->product->price, 0, ',', '.') }}</p>
  <p><strong>Jumlah di Keranjang:</strong> {{ $cart->quantity }} pcs</p>
  <p><strong>Subtotal Harga:</strong> Rp {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}</p>
  <p><strong>Deskripsi Produk:</strong> {{ $cart->product->description ?? 'Tidak ada deskripsi.' }}</p>

  <hr>

  <p>
    <a href="{{ route('carts.edit', $cart->id) }}">Ubah Jumlah Belanjaan Ini</a>
  </p>

</body>
</html>