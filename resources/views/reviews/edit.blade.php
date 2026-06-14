<!DOCTYPE html>
<html>
<head>
    <title>Edit Ulasan</title>
</head>
<body>

<!-- Halaman form untuk mengedit review -->
<h1>Edit Ulasan</h1>

<!-- Form update review -->
<form action="{{ route('reviews.update', $review->id) }}" method="POST">
    @csrf
    @method('PUT')
    <!-- Input rating review -->
    <label>Rating</label>
    <input type="number" name="rating" min="1" max="5" value="{{ $review->rating }}" required>
    <input type="hidden" name="from" value="{{ request('from') }}">
    <br><br>

    <!-- Input comment review -->
    <label>Komentar</label>
    <textarea name="comment" required>{{ $review->comment }}</textarea>
    <br><br>

    <button style="background: #2d6601; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
        type="submit">
        Perbarui
    </button>

    @if(request('from') == 'index')
        <button
            style="background: #4545a5; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
            type="button"
            onclick="window.location='{{ route('reviews.index') }}'">
            Tidak Jadi Ubah Ulasan
        </button>
    @elseif(request('from') == 'product')
        <button
            style="background: #4545a5; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
            type="button"
            onclick="window.location='{{ route('products.show', ['product' => $review->product_id]) }}'">
            Tidak Jadi Ubah Ulasan
        </button>
    @endif
</form>
</body>
</html>