<!DOCTYPE html>
<html>
<head>
    <title>News</title>
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
    <!-- Cek apakah user sudah login dan rolenya admin -->
    @if(Auth::check() && Auth::user()->role == 'admin')

        <h1>Daftar Berita</h1>
        <p>
            <a href="{{ route('admin.dashboard') }}" class="btn">Kembali ke Dashboard</a>
            <a href="{{ route('news.create') }}" class="btn">Tambah Berita</a>
        </p>
        <br>

        <table border="1" cellpadding="10">
            <tr>
                <th>Judul</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>

            <!-- Menampilkan daftar berita bentuk tabel (admin) -->
            @forelse($news as $item)
            <tr>
                <td>{{ $item->title }}</td>
                <td>{{ $item->created_at->format('d-m-Y') }}</td>
                <td>Aktif</td>
                <td>
                    <a href="{{ route('news.show', $item->id) }}" class="btn">Detail</a>
                    <a href="{{ route('news.edit', $item->id) }}" class="btn">Edit</a>
                    <form action="{{ route('news.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn" onclick="return confirm('Hapus berita ini?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4">Belum ada berita.</td>
            </tr>
            @endforelse
        </table>

    @else
        <!-- Tampilan user -->
        <h1>Berita</h1>
        <p>
            <a href="{{ route('home') }}" class="btn">Kembali ke Beranda</a>
        </p>
        <br>

        @forelse($news as $item)
        <div style="border: 1px solid #ccc; padding: 15px; margin-bottom: 15px;">
            <h3>{{ $item->title }}</h3>
            <p>{{ $item->content }}</p>
        </div>
        @empty
        <p>Belum ada berita.</p>
        @endforelse
    @endif
    </body>
</html>