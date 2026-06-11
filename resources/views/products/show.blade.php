<!DOCTYPE html>
<html>
<head>
    <title>Detail Produk</title>
    <style>
        .btn {
            padding: 5px 10px;
            text-decoration: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f2f2f2;
            color: black;
            font-size: 14px;
            cursor: pointer;
        }
    </style>
</head>
<body>

@if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

@if(session('success_html'))
    <p style="color: green;">{!! session('success_html') !!}</p>
@endif

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<!-- Menampilkan detail informasi product -->
<h1>{{ $product->name }}</h1>
<p>
    <a href="{{ route('products.index') }}" class="btn">
        Kembali ke Daftar Produk
    </a>
</p>
<p>Harga: Rp {{ number_format($product->price, 2, ',', '.') }}</p>
<p>Deskripsi: {{ $product->description }}</p>
<p>Kategori: {{ $product->category }}</p>
<hr>
<!-- Menampilkan daftar review untuk product tertentu -->
<h2>Ulasan</h2>

@forelse($product->reviews as $review)
    <!-- Menampilkan nama user yang menulis review -->
    <p><strong>{{ $review->user->name }}</strong></p>
    
    <!-- Menampilkan rating review -->
    <p>Rating: ⭐ {{ $review->rating }}</p>
    
    <!-- Menampilkan isi comment review -->
    <p>{{ $review->comment }}</p>

    <!-- Akses edit hanya untuk pemillik review -->
    @if(Auth::id() == $review->user_id)
        <a href="{{ route('reviews.edit', ['review' => $review->id, 'from' => 'product']) }}">
            [Ubah]
        </a>
    @endif
    <hr>
@empty
    <!-- Jika belum ada review -->
    <p>Belum ada ulasan.</p>
@endforelse

@if(!Auth::check() || Auth::user()->role !== 'admin')
    <a href="{{ route('reviews.create', ['product_id' => $product->id]) }}">
        Tambah Ulasan
    </a>
    <hr>
    <div style="display: flex; gap: 10px; margin-top: 10px;">
        <!-- Button add to cart product -->
        <form action="{{ route('carts.store', $product->id) }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="quantity" value="1">
            <button type="submit" class="btn">Tambah ke Keranjang</button>
        </form> 
        <!-- Button order now product -->
        <a href="{{ route('transactions.create', ['product_id' => $product->id, 'quantity' => 1]) }}" class="btn">
            Buat Pesanan Sekarang
        </a> 
    </div>
@endif