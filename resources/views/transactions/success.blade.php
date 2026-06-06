<!DOCTYPE html>
<html>
<head>
  <title>Transaksi Sukses</title>
</head>
<body>

  <div>
    <h1>Pembayaran Berhasil!</h1>
    <p>Terima kasih telah melakukan pembelian di toko kami.</p>

    @if(session('success'))
      <p><strong>Status:</strong> {{ session('success', 0) }}</p>
    @endif

    <div>
      <h3>Selamat! Kamu Mendapatkan:</h3>
      <p>+{{ session('earnedPoints', 0) }} Poin</p>
    </div>

    <p style="margin-top: 30px;">
        <a href="{{ route('products.index') }}">Belanja Lagi</a>
        <br>
        <a href="{{ route('transactions.index') }}">Lihat Riwayat Transaksi</a>
    </p>
  </div>

</body>
</html>