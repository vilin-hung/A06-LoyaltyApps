<!DOCTYPE html>
<html>
<head>
    <title>Detail Product</title>
</head>
<body>

<h1>{{ $product->name }}</h1>
<p>Price: {{ $product->price }}</p>
<p>Description: {{ $product->description }}</p>
<p>Category: {{ $product->category }}</p>

<hr>

<h2>Reviews</h2>

@forelse($product->reviews as $review)

    <p>
        <strong>{{ $review->user->name }}</strong>
    </p>

    <p>
        Rating: ⭐ {{ $review->rating }}
    </p>

    <p>
        {{ $review->comment }}
    </p>

    @if(Auth::id() == $review->user_id)
        <a href="{{ route('reviews.edit', $review->id) }}">
            Edit
        </a>
    @endif

    <hr>

@empty

    <p>Belum ada review.</p>

@endforelse
<a href="{{ route('reviews.create', ['product_id' => $product->id]) }}">
    Tambah Review
</a>