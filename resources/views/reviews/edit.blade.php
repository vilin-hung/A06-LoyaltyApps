<!DOCTYPE html>
<html>
<head>
    <title>Edit Review</title>
</head>
<body>

<!-- Halaman form untuk mengedit review -->
<h1>Edit Review</h1>

<!-- Form update review -->
<form action="{{ route('reviews.update', $review->id) }}" method="POST">
    @csrf
    @method('PUT')
    <!-- Input rating review -->
    <label>Rating</label>
    <input type="number" name="rating" min="1" max="5" value="{{ $review->rating }}" required>
    <br><br>

    <!-- Input comment review -->
    <label>Comment</label>
    <textarea name="comment" required>{{ $review->comment }}</textarea>
    <br><br>

    <button type="submit">
        Update
    </button>

</form>
</body>
</html>