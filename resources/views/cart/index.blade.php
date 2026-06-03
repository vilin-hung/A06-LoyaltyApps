@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Keranjang Belanja</h1>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  @if($cartItems->isEmpty())
    <p>Keranjang kosong. <a href="{{ route('products.index') }}">Belanja sekarang</a></p>
  @else
    <table class="table table-bordered">
      <thead>
        <tr>
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
          <td>{{ $item->product->name }}</td>
          <td>Rp {{ number_format($item->product->price) }}</td>
          <td>
            <form method="POST" action="{{ route('cart.update', $item) }}" style="display:inline;">
              @csrf
              @method('PUT')
              <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" style="width:70px;">
              <button type="submit" class="btn btn-sm btn-primary">Update</button>
            </form>
          </td>
          <td>Rp {{ number_format($item->product->price * $item->quantity) }}</td>
          <td>
            <form method="POST" action="{{ route('cart.destroy', $item) }}" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus item?')">Hapus</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <h4>Total: Rp {{ number_format($total) }}</h4>
    <a href="{{ route('cart.checkout') }}" class="btn btn-success" onclick="return confirm('Lanjutkan checkout?')">Checkout</a>
  @endif
</div>
@endsection