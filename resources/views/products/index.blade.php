<!DOCTYPE html>
<html>
<head>
    <title>Daftar Produk</title>
</head>
<body>

@if(session('success'))
    <p style="color: green;">
        {{ session('success') }}
    </p>
@endif

<!-- Halaman daftar all product -->
<h1>Daftar Produk</h1>

@if(Auth::check() && Auth::user()->role == 'admin')
    <div style="display:flex; gap:10px; margin-bottom:15px;">
        <button
            style="background: #4545a5; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
            type="button"
            onclick="window.location='{{ route('admin.dashboard') }}'">
            Kembali ke Beranda Admin
        </button>

        <button
            style="background: #4545a5; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
            type="button"
            onclick="window.location='{{ route('reviews.index') }}'">
            Lihat Ulasan
        </button>

        <button
            style="background: #4545a5; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
            type="button"
            onclick="window.location='{{ route('products.create') }}'">
            Tambah Produk
        </button>
    </div>
@else
    <div style="display:flex; gap:10px; margin-bottom:15px;">
        <button
            style="background: #4545a5; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
            type="button"
            onclick="window.location='{{ route('home') }}'">
            Kembali ke Beranda
        </button>

        <button
            style="background: #4545a5; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
            type="button"
            onclick="window.location='{{ route('reviews.index') }}'">
            Lihat Ulasan
        </button>
    </div>
@endif
<br>

@foreach($productsByCategory as $category => $categoryProducts)
    <h2>{{ $category }}</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>Nama</th>
            <th>Harga</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

    @foreach($categoryProducts as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>Rp {{ number_format($product->price, 2, ',', '.') }}</td>

            <td>
                @if($product->stock > 0)
                    Tersedia
                @else
                    Kosong
                @endif
            </td>

            <td>
                <button
                    style="background: #7b9e87; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
                    type="button"
                    onclick="window.location='{{ route('products.show', $product->id) }}'">
                    Detail
                </button>

                @if(Auth::check() && Auth::user()->role != 'admin')
                    <form action="{{ route('favorites.store', $product->id) }}"
                        method="POST"
                        style="display:inline;">
                        @csrf

                        <button
                            style="background: #ff4995; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
                            type="submit">
                            Favorit
                        </button>
                    </form>
                @endif

                @if(Auth::check() && Auth::user()->role == 'admin')
                    <button
                        style="background: #2d6601; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
                        type="button"
                        onclick="window.location='{{ route('products.edit', $product->id) }}'">
                        Ubah
                    </button>

                    <form action="{{ route('products.destroy', $product->id) }}"
                        method="POST"
                        style="display:inline;">
                        @csrf
                        @method('DELETE')

                        <button
                            style="background: #981e11; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
                            type="submit"
                            onclick="return confirm('Hapus product ini?')">
                            Hapus
                        </button>
                    </form>
                @endif
            </td>
        </tr>   
    @endforeach
    </table>
<br><br>
@endforeach
</body>
</html>