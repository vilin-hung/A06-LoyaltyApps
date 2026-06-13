<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
</head>
<body>

<!-- Halaman form untuk mengedit data product -->
<h1>Edit Produk</h1>

<form action="{{ route('products.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Input nama product -->
    <label>Nama:</label><br>
    <input type="text" name="name" value="{{ $product->name }}"><br><br>

    <!-- Input deskripsi product -->
    <label>Deskripsi:</label><br>
    <textarea name="description">{{ $product->description }}</textarea><br><br>

    <!-- Input harga product -->
    <label>Harga:</label><br>
    <input type="number" step="0.01" name="price" value="{{ $product->price }}"><br><br>

    <!-- Input stok product -->
    <label>Stok:</label><br>
    <input type="number" name="stock" value="{{ $product->stock }}"><br><br>

    <!-- Dropdown kategori product -->
    <label>Kategori:</label><br>
    <select name="category" required>
        <option value="">-- Pilih Kategori --</option>
        <option value="Coffee" {{ old('category', $product->category) == 'Coffee' ? 'selected' : '' }}>Coffee</option>
        <option value="Tea Blend" {{ old('category', $product->category) == 'Tea Blend' ? 'selected' : '' }}>Tea Blend</option>
        <option value="Milk Tea" {{ old('category', $product->category) == 'Milk Tea' ? 'selected' : '' }}>Milk Tea</option>
        <option value="Chocolate" {{ old('category', $product->category) == 'Chocolate' ? 'selected' : '' }}>Chocolate</option>
    </select>
    <br><br>
    <button
        style="background: #2d6601; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
        type="submit">
        Perbarui
    </button>
    <button
        style="background: #4545a5; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
        type="button"
        onclick="window.location='{{ route('products.index') }}'">
        Tidak Jadi Ubah Produk
    </button>
</form>

</body>
</html>