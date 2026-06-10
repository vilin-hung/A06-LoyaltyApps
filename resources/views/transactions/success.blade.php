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
      <p><strong>Status:</strong> {{ session('success') }}</p>
    @endif

    <div>
      <h3>Selamat! Kamu Mendapatkan:</h3>
      <p>+{{ session('earnedPoints', 0) }} Poin</p>
    </div>

    <p>     
      <form action="{{ route('products.index') }}">
        <button style="background: #7b9e87; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
           type="submit">
           Belanja Lagi 🤑
        </button>
      </form>
      <br>
      
      <form action="{{ route('transactions.index') }}">
        <button style="background: #7b9e87; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
          type="submit">
          Lihat Riwayat Transaksi
        </button>
      </form>
      <br>

      <form action="{{ route('home') }}">
        <button style="background: #4545a5; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
          type="submit">
          Kembali ke Beranda
        </button>
      </form>
    </p>
  </div>

</body>
</html>