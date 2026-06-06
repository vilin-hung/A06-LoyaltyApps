<!DOCTYPE html>
<html>
<head>
    <title>Create Review</title>
</head>
<body>

<!-- Halaman untuk menambahkan review baru -->
<h1>Tambah Review</h1>
<!-- Menampilkan nama product yang akan diberi review -->
<p>Product:<strong>{{ $product->name }}</strong></p>

<!-- Form untuk menyimpan review -->
<form action="{{ route('reviews.store') }}" method="POST">
    @csrf
    <!-- Menyimpan product_id agar review terhubung ke product -->
    <input type="hidden"
           name="product_id"
           value="{{ $product->id }}">

    <!-- Input rating (1-5) -->
    <label>Rating</label>
    <br>
    <input type="number"
           name="rating"
           min="1"
           max="5"
           required>
    <br><br>

    <!-- Input comment review -->
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