<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
</head>
<body>

<h1>Daftar Product</h1>

<a href="{{ route('products.create') }}">
    Tambah Product
</a>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Harga</th>
        <th>Aksi</th>
    </tr>

    @foreach($products as $product)
    <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->price }}</td>

        <td>
            <a href="{{ route('products.edit', $product->id) }}">
                Edit
            </a>
          
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')

                <button type="submit" onclick="return confirm('Yakin mau hapus?')">
                    Delete
                </button>
            </form>
        </td>
    </tr>
    @endforeach

</table>

</body>
</html>