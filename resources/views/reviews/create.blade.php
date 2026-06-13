<!DOCTYPE html>
<html>
<head>
    <title>Tambah Ulasan</title>
</head>
<body>

<!-- Halaman untuk menambahkan review baru -->
<h1>Tambah Ulasan</h1>
<!-- Menampilkan nama product yang akan diberi review -->
<p>Produk: <strong>{{ $product->name }}</strong></p>

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
    <label>Komentar</label>
    <br>
    <textarea name="comment" required></textarea>
    <br><br>

    <button 
        style="background: #2d6601; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
        type="submit">
        Simpan
    </button>
    <button 
        style="background: #4545a5; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
        type="button"
        onclick="window.location='{{ route('products.show', $product->id) }}'">
        Tidak Jadi Tambah Ulasan
    </button>
</form>
</body>
</html>