<!DOCTYPE html>
<html>
<head>
    <title>Create Review</title>
</head>
<body>

<h1>Tambah Review</h1>

<p>
    Product:
    <strong>{{ $product->name }}</strong>
</p>

<form action="{{ route('reviews.store') }}" method="POST">
    @csrf

    <input type="hidden"
           name="product_id"
           value="{{ $product->id }}">

    <label>Rating</label>
    <br>

    <input type="number"
           name="rating"
           min="1"
           max="5"
           required>

    <br><br>

    <label>Comment</label>
    <br>

    <textarea name="comment" required></textarea>

    <br><br>

    <button type="submit">
        Save
    </button>

</form>

</body>
</html>