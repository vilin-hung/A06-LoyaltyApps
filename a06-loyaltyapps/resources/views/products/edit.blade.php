<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>

<h1>Edit Product</h1>

<form action="{{ route('products.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nama:</label><br>
    <input type="text" name="name" value="{{ $product->name }}"><br><br>

    <label>Description:</label><br>
    <textarea name="description">{{ $product->description }}</textarea><br><br>

    <label>Price:</label><br>
    <input type="number" step="0.01" name="price" value="{{ $product->price }}"><br><br>

    <label>Stock:</label><br>
    <input type="number" name="stock" value="{{ $product->stock }}"><br><br>

    <label>Category:</label><br>
    <input type="text" name="category" value="{{ $product->category }}"><br><br>

    <button type="submit">
        Update
    </button>
</form>

</body>
</html>