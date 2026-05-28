<!DOCTYPE html>
<html>
<head>
    <title>Detail Product</title>
</head>
<body>

<!-- Menampilkan detail informasi product -->
<h1>{{ $product->name }}</h1>
<p>Price: {{ $product->price }}</p>
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