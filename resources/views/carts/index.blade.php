<!DOCTYPE html>
<html>
<head><title>Keranjang Belanja</title></head>
<body>

<div>
  <h2>Keranjang Belanja</h2>

  @if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
  @endif

  @if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
  @endif

  @if($cartItems->isEmpty())
    <p>Keranjang kosong. <a href="{{ route('products.index') }}">Belanja dulu</a></p>
  @else
      
    <form method="POST">
      @csrf

      <table border="1" cellpadding="5" cellspacing="0" style="width: auto; display: table; margin-left: 0;">
        <thead>
          <tr>
            <th>Pilih</th>
            <th>Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($cartItems as $item)
            <tr>
              <td>
                <input type="checkbox" name="cart_ids[]" value="{{ $item->id }}"
                {{ isset($checkedIds) && in_array($item->id, $checkedIds) ? 'checked' : '' }}>
              </td>
              <td>
                <strong>{{ $item->product->name }}</strong><br>
                <small>Stok: {{ $item->product->stock }}</small>
              </td>
              <td>Rp {{ number_format($item->product->price, 0, ',', '.') }}</td>
              <td>
                {{ $item->quantity }}
              </td>
              <td>Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</td>
              <td>
                <a href="{{ route('carts.edit', $item->id) }}">[Edit]</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <br>

      <div>
        <strong>Opsi Pembayaran & Voucher</strong><br>
        <label>Pilih Voucher Terbuka:</label>
        <select name="voucher_id">
          <option value="">-- Tanpa Voucher --</option>
          @foreach($myVouchers as $v)
            @php
              $isTemplateSelected = (isset($selectedVoucherId) && $selectedVoucherId == $v->id);
            @endphp
            <option value="{{ $v->id }}" {{ $isTemplateSelected ? 'selected' : '' }}>
              {{ $v->code }} (Potongan Rp {{ number_format($v->discount_amount, 0, ',', '.') }})
            </option>
          @endforeach
        </select>
        
        <br><br>
        
        <button type="submit" formaction="{{ route('carts.index') }}" formmethod="GET">
          Hitung Ulang Angka Pembayaran
        </button>
      </div>

      <br>

      <div>
        <p>Subtotal Terpilih: <strong>Rp {{ number_format($subtotalChosen ?? 0, 0, ',', '.') }}</strong></p>
        <p>Diskon Membership: <strong>-Rp {{ number_format($membershipDiscount ?? 0, 0, ',', '.') }}</strong></p>
        <p>Diskon Voucher: <strong>-Rp {{ number_format($voucherDiscount ?? 0, 0, ',', '.') }}</strong></p>
        <br><br>
        <h3>Total Akhir: Rp {{ number_format($totalFinal ?? 0, 0, ',', '.') }}</h3>
        
        <button type="submit" formaction="{{ route('carts.checkout') }}" method="POST">
          Buat Pesanan Sekarang
        </button>
      </div>

  </form>
  @endif
</div>

</body>
</html>