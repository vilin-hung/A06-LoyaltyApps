<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Transaksi Berhasil</title>
</head>
<body>

<div>
    <h2 style="color: green;">Pesanan Berhasil Dibuat!</h2>
    
    @if(session('success'))
        <p><strong>Status:</strong> {{ session('success') }}</p>
    @endif

    <fieldset>
        <legend>Informasi Reward Anda</legend>
        <p>Selamat! Dari transaksi ini, Anda berhasil mendapatkan tambahan:</p>
        <h3>+ {{ session('earnedPoints') ?? 0 }} Poin</h3>
        <small>*Poin telah otomatis ditambahkan ke akun Anda dan bisa ditukarkan dengan voucher baru.</small>
    </fieldset>

    <br>

    <h3>Rangkuman Nota Transaksi</h3>
    <table border="1" cellpadding="5" cellspacing="0" style="width: 100%;">
        <thead>
            <tr>
                <th>Status Pembayaran</th>
                <th>Metode</th>
                <th>Pemotongan Saldo</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong style="color: green;">LUNAS</strong></td>
                <td>Saldo Akun</td>
                <td><strong>Otomatis Terpotong</strong></td>
            </tr>
        </tbody>
    </table>

    <br><br>
    
    <a href="{{ route('products.index') }}"><button style="padding: 10px 20px;">Kembali Belanja</button></a>
    <a href="{{ route('carts.index') }}"><button style="padding: 10px 20px;">Lihat Keranjang Lagi</button></a>
</div>

</body>
</html>