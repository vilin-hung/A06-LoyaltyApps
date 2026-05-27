@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Buat Order Baru</h1>

  @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  <form method="POST" action="{{ route('transactions.store') }}">
    @csrf
    <div class="form-group">
      <label>Pilih Produk</label>
      <select name="product_id" class="form-control" required>
        @foreach($products as $product)
          <option value="{{ $product->id }}">
            {{ $product->name }} - Rp {{ number_format($product->price) }} (Stok: {{ $product->stock }})
          </option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>Jumlah</label>
      <input type="number" name="quantity" class="form-control" min="1" required>
    </div>
    <button type="submit" class="btn btn-primary">Beli</button>
  </form>
</div>
@endsection