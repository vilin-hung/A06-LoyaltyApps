<!DOCTYPE html>
<html>
<head>
    <title>Ulasan</title>
</head>
<body>

<!-- Halaman untuk menampilkan daftar review -->
<h1>Daftar Ulasan</h1>

@if(Auth::check() && Auth::user()->role == 'admin')
    <div style="display:flex; gap:10px; margin-bottom:15px;">
        <form action="{{ route('admin.dashboard') }}">
            <button
                style="background: #4545a5; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
                type="submit">
                Kembali ke Beranda Admin
            </button>
        </form>
        <button
            style="background: #4545a5; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
            type="button"
            onclick="window.location='{{ route('products.index') }}'">
            Daftar Produk
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
            onclick="window.location='{{ route('products.index') }}'">
            Daftar Produk
        </button>
    </div>
@endif
<br>

<table border="1" cellpadding="10">
    <tr>
        <th>Pengguna</th>
        <th>Produk</th>
        <th>Rating</th>
        <th>Komentar</th>
        <th>Aksi</th>
    </tr>

    @foreach($reviews as $review)
    <tr>
        <!-- Menampilkan nama user yang memberi review -->
        <td>{{ $review->user->name }}</td>

        <!-- Menampilkan nama product yang direview -->
        <td>{{ $review->product->name }}</td>

        <!-- Menampilkan rating review -->
        <td style="text-align:center">{{ $review->rating }}</td>

        <!-- Menampilkan isi comment review -->
        <td>{{ $review->comment }}</td>

        <td>
            {{-- User pemilik review bisa edit --}}
            @if(Auth::check() && Auth::id() == $review->user_id)
                <a href="{{ route('reviews.edit', ['review' => $review->id, 'from' => 'index']) }}"  
                    style="background: #2d6601; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;">
                    Ubah
                </a>
            @endif
            <!-- Aksi delete review (admin only) -->
            @if(Auth::check() && Auth::user()->role == 'admin')
                <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')

                    <button style="background: #981e11; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
                        type="submit" 
                        onclick="return confirm('Hapus review ini?')">
                        Hapus
                    </button>
                </form>
            @endif
        </td>
    </tr>
    @endforeach

</table>
</body>
</html>