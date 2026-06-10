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
      
    <form action="{{ route('carts.index') }}" method="GET" id="cart-calculation-form">
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
              <td style="text-align:center">
                <input type="checkbox"
                      name="cart_ids[]"
                      value="{{ $item->id }}"
                      form="cart-calculation-form"
                      {{ isset($checkedIds) && in_array($item->id, $checkedIds) ? 'checked' : '' }}>
              </td>

              <td>
                <strong>{{ $item->product->name }}</strong><br>
                <small>Stok: {{ $item->product->stock }}</small>
              </td>

              <td>
                Rp {{ number_format($item->product->price, 0, ',', '.') }}
              </td>
              
              <td style="text-align:center">
                {{ $item->quantity }}
              </td>

              <td>
                Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
              </td>

              <td>
                <button style="background: #7b9e87; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
                  type="button"
                  onclick="window.location='{{ route('carts.show', $item->id) }}'">
                  Detail
                </button>

                <button style="background: #2d6601; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
                  type="submit"
                  form="edit-form-{{ $item->id }}">
                  Ubah
                </button>
  
                <button style="background: #981e11; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
                    type="submit"
                    form="delete-form-{{ $item->id }}"
                    onclick="return confirm('Hapus product ini?')">
                  Hapus
                </button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <br>

      <div>
        <strong>Opsi Pembayaran & Voucher</strong><br>
        <label>Pilih Voucher:</label>
        <select name="voucher_id" form="cart-calculation-form">
          <option value="">-- Tanpa Voucher --</option>
          @foreach($myVouchers as $v)
            @php
              $isTemplateSelected = (isset($selectedVoucherId) && $selectedVoucherId == $v->id);
            @endphp
            <option value="{{ $v->id }}" {{ $isTemplateSelected ? 'selected' : '' }}>
              @if($v->discount_type === 'percentage')
                {{ $v->code }} (Potongan {{ $v->discount_value }}%)
              @else
                {{ $v->code }} (Potongan Rp {{ number_format($v->discount_value, 0, ',', '.') }})
              @endif
            </option>
          @endforeach
        </select>
        
        <br><br>
        
        <button style="background: #4545a5; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
          type="submit"
          formaction="{{ route('carts.index') }}"
          formmethod="GET">
          Hitung Ulang Angka Pembayaran
        </button>
      </div>
    </form>
    <hr>
    <div>
      <p>Subtotal Terpilih: <strong>Rp {{ number_format($subtotalChosen ?? 0, 0, ',', '.') }}</strong></p>
      <p>Diskon Membership: <strong>-Rp {{ number_format($membershipDiscount ?? 0, 0, ',', '.') }}</strong></p>
      <p>Diskon Voucher: <strong>-Rp {{ number_format($voucherDiscount ?? 0, 0, ',', '.') }}</strong></p>
      <hr>
      <h3>Total Akhir: Rp {{ number_format($totalFinal ?? 0, 0, ',', '.') }}</h3>
      
      <form action="{{ route('carts.checkout') }}" method="POST" id="checkout-form">
      @csrf

      @if(isset($checkedIds))
        @foreach($checkedIds as $id)
          <input type="hidden"
                name="cart_ids[]"
                value="{{ $item->id }}">
        @endforeach
      @endif

      @if(isset($selectedVoucherId))
        <input type="hidden"
              name="voucher_id"
              value="{{ $selectedVoucherId }}">
      @endif

      <button style="background: #7b9e87; color: #f7f4ef; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
          type="submit">
          Buat Pesanan Sekarang
        </button>
      </form>

      <br><br>
      <p>Tidak jadi belanja? <a href="{{ route('products.index') }}">Lihat Daftar Produk</a></p>
    </div>

  @foreach($cartItems as $item)
    <form id="edit-form-{{ $item->id }}"
      action="{{ route('carts.edit', $item->id) }}" 
      method="GET">
    </form>
  
    <form id="delete-form-{{ $item->id }}"
      action="{{ route('carts.destroy', $item->id) }}" 
      method="POST">
      @csrf
      @method('DELETE')
    </form>
  @endforeach
@endif

    @if(auth()->user()->role === 'user')
        <form action="{{ route('home') }}">
          <button style="background: #4545a5; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
            type="submit">
            Kembali ke Beranda
          </button>
        </form>        
    @endif

    @if(auth()->user()->role === 'admin')
        <form action="{{ route('admin.dashboard') }}">
          <button style="background: #4545a5; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
            type="submit">
            Kembali ke Beranda Admin
          </button>
        </form>
    @endif
    </p>
</div>

</body>
</html>