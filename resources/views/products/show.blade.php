<!DOCTYPE html>
<html>
<head>
    <title>Detail Produk</title>
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
    <button
        style="background: #4545a5; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
        type="button"
        onclick="window.location='{{ route('products.index') }}'">
        Kembali ke Daftar Produk
    </button>
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
        <a href="{{ route('reviews.edit', ['review' => $review->id, 'from' => 'product', 'product_id' => $review->product_id]) }}"
            style="background: #2d6601; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer; text-decoration:none; display:inline-block;">
            Ubah
        </a>
    @endif
    <hr>
@empty
    <!-- Jika belum ada review -->
    <p>Belum ada ulasan.</p>
@endforelse

@if(!Auth::check() || Auth::user()->role !== 'admin')
    <button
        style="background: #4545a5; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
        type="button"
        onclick="window.location='{{ route('reviews.create', ['product_id' => $product->id]) }}'">
        Tambah Ulasan
    </button>
    <hr>
    <div style="display: flex; gap: 10px; margin-top: 10px;">
        <!-- Button add to cart product -->
        <form action="{{ route('carts.store', $product->id) }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="quantity" value="1">
            <button
                style="background: #7b9e87; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
                type="submit">
                Tambah ke Keranjang
            </button>
        </form>    
        <!-- Button order now product -->
        <button
            style="background: #7b9e87; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
            type="button"
            onclick="window.location='{{ route('transactions.create', ['product_id' => $product->id, 'quantity' => 1]) }}'">
            Buat Pesanan Sekarang
        </button>
    </div>
@endif