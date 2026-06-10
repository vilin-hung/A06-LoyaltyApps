<!DOCTYPE html>
<head>
  <title>Beranda Admin - Riwayat Transaksi</title>
</head>
<body>
  <h2>Transaksi Pelanggan</h2>

  @if(session('success'))
    <div style="color: green; font-weight: bold; margin-bottom: 15px;">
      {{ session('success') }}
    </div>
  @endif

  @if($transactions->isEmpty())
    <p>Belum ada transaksi yang terjadi dalam sistem.</p>
  @else
    <table border="1" cellpadding="8" cellspacing="0" style="width: 100%; max-width: 900px; border-collapse: collapse;">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nama Pelanggan</th>
          <th>Tanggal & Waktu</th>
          <th>Total Bayar</th>
          <th>Pemakaian Voucher</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($transactions as $transaction)
          <tr>
            <td>#{{ $transaction->id }}</td>
            <td><strong>{{ $transaction->user->name ?? 'User Terhapus' }}</strong></td>
            <td>{{ $transaction->created_at->format('d M Y, H:i') }} WIB</td>
            <td>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
            <td>
              @if($transaction->voucher)
                <span style="background-color: #e8f8f5; color: #117a65; padding: 2px 6px; border-radius: 4px;">
                  {{ $transaction->voucher->code }}
                </span>
              @else
                <span style="color: gray;">-</span>
              @endif
            </td>
            <td>
              <a href="{{ route('transactions.show', $transaction->id) }}">
                <button style="background-color: #e8f8f5; color: #117a65; border-color: #e8f8f5;padding: 2px 6px; border-radius: 4px;"
                  type="button">
                  Detail Nota
                </button>
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endif

  <br><br>
  <form action="{{ route('admin.dashboard') }}">
    <button style="background: #4545a5; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
      type="submit">
      Kembali ke Beranda Admin
    </button>
  </form>

</body>
</html>