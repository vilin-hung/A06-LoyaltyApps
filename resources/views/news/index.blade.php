<!DOCTYPE html>
<html>
<head>
    <title>News</title>
    <style>
        body { margin: 20px; color: #333; }
        .btn { padding: 8px 16px; border: none; border-radius: 6px; cursor: pointer; text-decoration: none; display: inline-block; font-size: 14px; }
        .btn_blue { background: #4545a5; color: #fff6fd; }
        .btn_green { background: #7b9e87; color: #fff6fd; }
        .btn_red { background: #cb4335; color: white; }
        .table { border-collapse: collapse; width: 100%;}
        .table th, .table td { padding: 10px; border: 1px solid #ccc; }
        .table th { background-color: #f3f4f6; }
        .card { border: 1px solid #ccc; padding: 15px; margin-bottom: 15px; border-radius: 6px; }
    </style>
</head>
<body>
    <!-- Cek apakah user sudah login dan rolenya admin -->
    @if(Auth::check() && Auth::user()->role == 'admin')

        <!-- Tampilan Admin -->
        <h1>Daftar Berita</h1>
        <p>
            <a href="{{ route('admin.dashboard') }}" class="btn btn_blue">Kembali ke Beranda Admin</a>
            &nbsp;&nbsp;
            <a href="{{ route('news.create') }}" class="btn btn_green">Tambah Berita</a>
        </p>

        @if(session('success'))
            <p style="color: green;"><b>{{ session('success') }}</b></p>
        @endif <br>

        <table class="table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                    <th>Tampilkan</th>
                </tr>
            </thead>
            <tbody>
                <!-- Menampilkan daftar berita dalam bentuk tabel (admin) -->
                @forelse($news as $item)
                <tr style="text-align:center">
                    <td style="font-weight: bold; text-align: left;">{{ $item->title }}</td>
                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                    <td>
                        <a href="{{ route('news.show', $item->id) }}" class="btn btn_green">Detail</a>
                        <a href="{{ route('news.edit', $item->id) }}" class="btn btn_green">Ubah</a>
                        <form action="{{ route('news.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn_red" onclick="return confirm('Hapus berita ini?')">Hapus</button>
                        </form>
                    </td>
                    <td>
                        <!-- Update status jika mau tampilkan/sembunyikan berita -->
                        <form id="status-form-{{ $item->id }}" method="POST" action="{{ route('news.update', $item->id) }}" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="title" value="{{ $item->title }}">
                            <input type="hidden" name="content" value="{{ $item->content }}">
                            <input type="hidden" name="status" value="{{ $item->status ? '0' : '1' }}">
                            <button type="submit" class="btn {{ $item->status ? 'btn_red' : 'btn_green' }}">
                                {{ $item->status ? 'Sembunyikan' : 'Tampilkan' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr style="text-align:center">
                    <td colspan="4">Belum ada berita.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    @else
        <!-- Tampilan user -->
        <h1>Berita</h1>
        <p>
            <a href="{{ route('home') }}" class="btn btn_blue">Kembali ke Beranda</a>
        </p>

        @forelse($news as $item)
        <div class="card">
            <h3 style="margin-top: 0;">{{ $item->title }}</h3>
            <p>{{ $item->content }}</p>
        </div>
        @empty
        <p>Belum ada berita.</p>
        @endforelse
    @endif
    </body>
</html>