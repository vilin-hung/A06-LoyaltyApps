<!DOCTYPE html>
<html>
<head>
    <title>Tambah Product</title>
</head>
<body>

<h1>Tambah Product</h1>

<form action="{{ route('products.store') }}" method="POST">
    @csrf

    <label>Nama:</label><br>
    <input type="text" name="name"><br><br>

    <label>Description:</label><br>
    <textarea name="description"></textarea><br><br>

    <label>Price:</label><br>
    <input type="number" step="0.01" name="price"><br><br>

    <label>Stock:</label><br>
    <input type="number" name="stock"><br><br>

    <label>Category:</label><br>
    <input type="text" name="category"><br><br>

    <button type="submit">
        Simpan
    </button>
</form>

</body>
</html>