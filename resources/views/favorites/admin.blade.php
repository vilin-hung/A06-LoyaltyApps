<h1>Daftar Produk Favorit</h1>

<table border="1" cellpadding="10">
    <tr>
        <th>Produk</th>
        <th>Jumlah Favorit</th>
    </tr>

    @foreach($favorites as $favorite)
    <tr>
        <td>{{ $favorite->product->name }}</td>
        <td>{{ $favorite->total }}</td>
    </tr>
    @endforeach
</table>

<a href="{{ route('admin.dashboard') }}">
    Kembali ke Dashboard
</a>