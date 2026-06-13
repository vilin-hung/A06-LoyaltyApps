<!DOCTYPE html>
<html>
<head>
    <title>Edit Berita</title>
    <style>
        body { margin: 20px; color: #333; }
        .btn { padding: 8px 12px; border: none; border-radius: 6px; cursor: pointer; text-decoration: none; display: inline-block; font-size: 14px; }
        .btn_blue { background: #4545a5; color: #fff6fd; }
        .btn_green { background: #7b9e87; color: #fff6fd; }
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
        <button type="submit" class="btn btn_green">Update</button>
    </form> <br>
    
    <a href="{{ route('news.index') }}" class="btn btn_blue">Kembali ke Daftar Berita</a>
</body>
</html>