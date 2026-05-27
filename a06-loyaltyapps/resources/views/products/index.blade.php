<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <style>
        .btn {
            padding: 5px 10px;
            text-decoration: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f2f2f2;
            color: black;
            font-size: 14px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h1>Daftar Product</h1>

@if(Auth::check() && Auth::user()->role == 'admin')
    <a href="{{ route('products.create') }}">
        Tambah Product
    </a>
@endif

<table border="1" cellpadding="10">
    <tr>
        <th>Nama</th>
        <th>Harga</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($products as $product)
    <tr>
        <td>{{ $product->name }}</td>
        <td>Rp {{ number_format($product->price, 2, ',', '.') }}</td>

        <td>
            @if($product->stock > 0)
                Available
            @else
                Out of Stock

            @endif
        </td>
        <td>
            <a href="{{ route('products.show', $product->id) }}" class="btn">
                Detail
            </a>  
             
            @if(Auth::check() && Auth::user()->role == 'admin')
                <a href="{{ route('products.edit', $product->id) }}" class="btn">
                    Edit
                </a>
                
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn" onclick="return confirm('Hapus product ini?')">
                        Delete
                    </button>
                </form>
            @endif
        </td>
    </tr>
    @endforeach

</table>

</body>
</html>