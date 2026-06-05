<!DOCTYPE html>
<html>
<head>
  <title>Transaksi Sukses</title>
</head>
<body>

  <div style="text-align: center; margin-top: 50px;">
    <h1 style="color: green;">Pembayaran Berhasil!</h1>
    <p>Terima kasih telah melakukan pembelian di toko kami.</p>


    @if(session('success'))
      <p><strong>Status:</strong> {{ session('success') }}</p>
    @endif

    <div style="background-color: #f0fdf4; border: 1px solid #bbf7d0; display: inline-block; padding: 15px 30px; border-radius: 8px;">
      <h3 style="margin: 0; color: #16a34a;">Selamat! Kamu Mendapatkan:</h3>
      <p style="font-size: 24px; font-weight: bold; margin: 10px 0; color: #15803d;">
          +{{ session('earnedPoints', 0) }} Poin
        </p>
    </div>

    <p style="margin-top: 30px;">
        <a href="{{ route('products.index') }}" style="padding: 10px 15px; background-color: #3b82f6; color: white; text-decoration: none; border-radius: 5px;">Belanja Lagi</a>
        <a href="{{ route('transactions.history') }}" style="padding: 10px 15px; background-color: #6b7280; color: white; text-decoration: none; border-radius: 5px; margin-left: 10px;">Lihat Riwayat Transaksi</a>
    </p>
  </div>

</body>
</html>