<!DOCTYPE html>
<html>
<head>
    <title>Edit Berita</title>
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
    <h1>Edit Berita</h1>

    @if(session('success'))
        <p style="color: green;"><b>{{ session('success') }}</b></p>
    @endif <br>

    <!-- Form edit berita -->
    <form method="POST" action="{{ route('news.update', $news->id) }}"> 
        @csrf
        @method('PUT')
        <p>
            <label>Judul:</label><br>
            <input type="text" name="title" value="{{ $news->title }}" required>
        </p>
        <p>
            <label>Konten:</label><br>
            <textarea name="content" required>{{ $news->content }}</textarea>
        </p>
        <button type="submit" class="btn">Update</button>
    </form>
    <br>
    <a href="{{ route('news.index') }}">Kembali ke Daftar Berita</a>
</body>
</html>