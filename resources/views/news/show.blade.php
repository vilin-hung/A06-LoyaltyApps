<!DOCTYPE html>
<html>
<head>
    <title>Detail Berita</title>
    <style>
        body { margin: 20px; color: #333; }
        .btn { padding: 8px 16px; border: none; border-radius: 6px; cursor: pointer; text-decoration: none; display: inline-block; font-size: 14px; }
        .btn_blue { background: #4545a5; color: #fff6fd; }
        .content-box { border: 1px solid #ccc; border-radius: 6px; padding: 20px; }
    </style>
</head>
<body>
    <h1>Detail Berita</h1>
    <!-- Menampilkan konten secara detail -->
    <fieldset class="content-box">
        <legend style="font-weight: bold; font-size: 1.2em;">{{ $news->title }}</legend>
        <p>{{ $news->content }}</p>
        <small style="color: #666;">Tanggal: {{ $news->created_at }}</small>
    </fieldset>
    
    <br>
    <a href="{{ route('news.index') }}" class="btn btn_blue">Kembali ke Daftar Berita</a>
</body>
</html>