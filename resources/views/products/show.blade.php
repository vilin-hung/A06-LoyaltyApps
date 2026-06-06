<!DOCTYPE html>
<html>
<head>
    <title>Detail Product</title>
</head>
<body>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<!-- Menampilkan detail informasi product -->
<h1>{{ $product->name }}</h1>
<p>
    <a href="{{ route('products.index') }}" class="btn">
        Kembali
    </a>
</p>
<p>Price: Rp {{ number_format($product->price, 2, ',', '.') }}</p>
<p>Description: {{ $product->description }}</p>
<p>Category: {{ $product->category }}</p>
<hr>
<!-- Menampilkan daftar review untuk product tertentu -->
<h2>Reviews</h2>

@forelse($product->reviews as $review)
    <!-- Menampilkan nama user yang menulis review -->
    <p><strong>{{ $review->user->name }}</strong></p>
    
    <!-- Menampilkan rating review -->
    <p>Rating: ⭐ {{ $review->rating }}</p>
    
    <!-- Menampilkan isi comment review -->
    <p>{{ $review->comment }}</p>

    <!-- Akses edit hanya untuk pemillik review -->
    @if(Auth::id() == $review->user_id)
        <a href="{{ route('reviews.edit', $review->id) }}">Edit</a>
    @endif
    <hr>
@empty
    <!-- Jika belum ada review -->
    <p>Belum ada review.</p>
@endforelse

<a href="{{ route('reviews.create', ['product_id' => $product->id]) }}">
    Tambah Review
</a>
<hr>
<!-- Button add to cart product -->
@if(!Auth::check() || Auth::user()->role !== 'admin')
<!-- Button add to cart product -->
    <form action="{{ route('carts.store', $product->id) }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">
        <input type="hidden" name="quantity" value="1">
        <button type="submit" class="btn">Add To Cart</button>
    </form> 
    {{--
    <a href="{{ route('transactions.order', $product->id) }}" class="btn">
        Order Now
    </a> --}}
@endif