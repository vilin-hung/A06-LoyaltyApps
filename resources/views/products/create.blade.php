<!DOCTYPE html>
<html>
<head>
    <title>Tambah Product</title>
</head>
<body>

<!-- Halaman form untuk menambahkan product baru -->
<h1>Tambah Product</h1>

<form action="{{ route('products.store') }}" method="POST">
    @csrf
    <!-- Input nama product -->
    <label>Nama:</label><br>
    <input type="text" name="name"><br><br>

    <!-- Input deskripsi product -->
    <label>Description:</label><br>
    <textarea name="description"></textarea><br><br>

    <!-- Input harga product -->
    <label>Price:</label><br>
    <input type="number" step="0.01" name="price"><br><br>

    <!-- Input stok product -->
    <label>Stock:</label><br>
    <input type="number" name="stock"><br><br>

    <!-- Dropdown kategori product -->
    <label>Category:</label><br>
    <select name="category" required>
        <option value="">-- Pilih Category --</option>
        <option value="beverages" {{ old('category') == 'beverages' ? 'selected' : '' }}>Beverages</option>
        <option value="snacks" {{ old('category') == 'snacks' ? 'selected' : '' }}>Snacks</option>
    </select>

    @error('category')
        <div style="color:red">{{ $message }}</div>
    @enderror

    <br><br>

    <button type="submit">
        Simpan
    </button>
</form>

</body>
</html>