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

        <!-- Tampilan Admin -->
        <h1>Daftar Berita</h1>
        <p>
            <a href="{{ route('admin.dashboard') }}" class="btn">Kembali ke Beranda Admin</a>
            <a href="{{ route('news.create') }}" class="btn">Tambah Berita</a>
        </p>
        <br>

        @if(session('success'))
            <p style="color: green;"><b>{{ session('success') }}</b></p>
        @endif <br>

        <table border="1" cellpadding="10">
            <tr>
                <th>Judul</th>
                <th>Tanggal</th>
                <th>Aksi</th>
                <th>Tampilkan</th>
            </tr>

            <!-- Menampilkan daftar berita bentuk tabel (admin) -->
            @forelse($news as $item)
            <tr>
                <td>{{ $item->title }}</td>
                <td>{{ $item->created_at->format('d-m-Y') }}</td>
                <td>
                    <a href="{{ route('news.show', $item->id) }}" class="btn">Detail</a>
                    <a href="{{ route('news.edit', $item->id) }}" class="btn">Ubah</a>
                    <form action="{{ route('news.destroy', $item->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn" onclick="return confirm('Hapus berita ini?')">Hapus</button>
                    </form>
                </td>
                <td>
                    <form id="status-form-{{ $item->id }}" method="POST" action="{{ route('news.update', $item->id) }}" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="title" value="{{ $item->title }}">
                        <input type="hidden" name="content" value="{{ $item->content }}">
                        <input type="hidden" name="status" value="{{ $item->status ? '0' : '1' }}">
                        <button type="submit" class="btn">
                            {{ $item->status ? 'Sembunyikan' : 'Tampilkan' }}
                        </button>
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