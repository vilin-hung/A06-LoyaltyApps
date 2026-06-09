<!DOCTYPE html>
<html>
<head>
    <title>Detail Berita</title>
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
    <h1>Detail Berita</h1>
    <!-- Untuk menampilkan konten secara detail -->
    <fieldset>
        <legend>{{ $news->title }}</legend>
        <p>{{ $news->content }}</p>
        <small>Tanggal: {{ $news->created_at }}</small>
    </fieldset>
    <br>
    <a href="{{ route('news.index') }}">Kembali ke Daftar Berita</a>
</body>
</html>