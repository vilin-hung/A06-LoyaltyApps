<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>

<!-- Halaman form untuk mengedit data product -->
<h1>Edit Product</h1>

<form action="{{ route('products.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Input nama product -->
    <label>Nama:</label><br>
    <input type="text" name="name" value="{{ $product->name }}"><br><br>

    <!-- Input deskripsi product -->
    <label>Description:</label><br>
    <textarea name="description">{{ $product->description }}</textarea><br><br>

    <!-- Input harga product -->
    <label>Price:</label><br>
    <input type="number" step="0.01" name="price" value="{{ $product->price }}"><br><br>

    <!-- Input stok product -->
    <label>Stock:</label><br>
    <input type="number" name="stock" value="{{ $product->stock }}"><br><br>

    <!-- Dropdown kategori product -->
    <label>Category:</label><br>
    <select name="category" required>
        <option value="">-- Pilih Category --</option>
        <option value="beverages" {{ old('category', $product->category) == 'beverages' ? 'selected' : '' }}>Beverages</option>
        <option value="snacks" {{ old('category', $product->category) == 'snacks' ? 'selected' : '' }}>Snacks</option>
    </select>

    <button type="submit">
        Update
    </button>
</form>

</body>
</html>