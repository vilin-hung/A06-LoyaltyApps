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
        <option value="">-- Pilih Kategori --</option>
        <option value="Coffee" {{ old('category') == 'Coffee' ? 'selected' : '' }}>Coffee</option>
        <option value="Tea Blend" {{ old('category') == 'Tea Blend' ? 'selected' : '' }}>Tea Blend</option>
        <option value="Milk Tea" {{ old('category') == 'Milk Tea' ? 'selected' : '' }}>Milk Tea</option>
        <option value="Chocolate" {{ old('category') == 'Chocolate' ? 'selected' : '' }}>Chocolate</option>
    </select>

    @error('category')
        <div style="color:red">{{ $message }}</div>
    @enderror

    <br><br>

    <button
        style="background: #2d6601; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
        type="submit">
        Simpan
    </button>
    <button
        style="background: #4545a5; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
        type="button"
        onclick="window.location='{{ route('products.index') }}'">
        Tidak Jadi Tambah Produk
    </button>
</form>

</body>
</html>