<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
</head>
<body>

<!-- Halaman form untuk menambahkan product baru -->
<h1>Tambah Produk</h1>

<form action="{{ route('products.store') }}" method="POST">
    @csrf
    <!-- Input nama product -->
    <label>Nama:</label><br>
    <input type="text" name="name"><br><br>

    <!-- Input deskripsi product -->
    <label>Deskripsi:</label><br>
    <textarea name="description"></textarea><br><br>

    <!-- Input harga product -->
    <label>Harga:</label><br>
    <input type="number" step="0.01" name="price"><br><br>

    <!-- Input stok product -->
    <label>Stok:</label><br>
    <input type="number" name="stock"><br><br>

    <!-- Dropdown kategori product -->
    <label>Kategori:</label><br>
    <select name="category" required>
        <option value="">-- Pilih Category --</option>
        <option value="minuman" {{ old('category') == 'minuman' ? 'selected' : '' }}>minuman</option>
        <option value="makanan" {{ old('category') == 'makanan' ? 'selected' : '' }}>makanan</option>
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