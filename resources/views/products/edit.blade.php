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
        <option value="Coffee" {{ old('category') == 'Coffee' ? 'selected' : '' }}>Coffee</option>
        <option value="Tea Blend" {{ old('category') == 'Tea Blend' ? 'selected' : '' }}>Tea Blend</option>
        <option value="Milk Tea" {{ old('category') == 'Milk Tea' ? 'selected' : '' }}>Milk Tea</option>
        <option value="Chocolate" {{ old('category') == 'Chocolate' ? 'selected' : '' }}>Chocolate</option>
    </select>

    <button type="submit">
        Perbarui 
    </button>
</form>

</body>
</html>