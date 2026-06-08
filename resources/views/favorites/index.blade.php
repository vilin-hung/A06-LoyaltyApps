<!DOCTYPE html>
<html>
<head>
    <title>Produk Favorit</title>
</head>
<body>

<h1>Produk Favorit Saya</h1>

@if(session('success'))
    <p style="color:green;">
        {{ session('success') }}
    </p>
@endif

<table border="1" cellpadding="10">
    <tr>
        <th>Produk</th>
        <th>Aksi</th>
    </tr>

    @forelse($favorites as $favorite)
        <tr>
            <td>{{ $favorite->product->name }}</td>
            <td>
                <form action="{{ route('favorites.destroy', $favorite->product->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="2">
                Belum ada produk favorit
            </td>
        </tr>
    @endforelse
</table>

<br>

<a href="{{ route('products.index') }}">
    Kembali ke Produk
</a>

</body>
</html>