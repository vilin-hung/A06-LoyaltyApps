<!DOCTYPE html>
<html>
<head>
    <title>Ulasan</title>
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

<!-- Halaman untuk menampilkan daftar review -->
<h1>Daftar Ulasan</h1>

@if(Auth::check() && Auth::user()->role == 'admin')
    <p>
        <a href="{{ route('admin.dashboard') }}" class="btn">
            Kembali ke Beranda Admin
        </a>  
        &nbsp;&nbsp;
        <a href="{{ route('products.index') }}" class="btn">
            Daftar Produk
        </a>
    </p>
@else
    <p>
        <a href="{{ route('home') }}" class="btn">
            Kembali ke Beranda
        </a>
        &nbsp;&nbsp;
        <a href="{{ route('products.index') }}" class="btn">
            Daftar Produk
        </a>
    </p>
@endif
<br>

<table border="1" cellpadding="10">
    <tr>
        <th>User</th>
        <th>Product</th>
        <th>Rating</th>
        <th>Comment</th>
        <th>Action</th>
    </tr>

    @foreach($reviews as $review)
    <tr>
        <!-- Menampilkan nama user yang memberi review -->
        <td>{{ $review->user->name }}</td>

        <!-- Menampilkan nama product yang direview -->
        <td>{{ $review->product->name }}</td>

        <!-- Menampilkan rating review -->
        <td>{{ $review->rating }}</td>

        <!-- Menampilkan isi comment review -->
        <td>{{ $review->comment }}</td>

        <td>
            {{-- User pemilik review bisa edit --}}
            @if(Auth::check() && Auth::id() == $review->user_id)
                <a href="{{ route('reviews.edit', ['review' => $review->id, 'from' => 'index']) }}" class="btn">
                    Ubah
                </a>
            @endif
            <!-- Aksi delete review (admin only) -->
            @if(Auth::check() && Auth::user()->role == 'admin')
                <form action="{{ route('reviews.destroy', $review->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" onclick="return confirm('Hapus review ini?')">
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