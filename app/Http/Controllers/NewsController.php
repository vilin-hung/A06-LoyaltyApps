<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class NewsController extends Controller implements HasMiddleware
{
    // Mengatur hak akses route berita
    public static function middleware(): array
    {
        return [
            // Hanya admin yang bisa CRUD, kecuali 'index' dan 'show' untuk publik/user
            new Middleware('admin', except: ['index', 'show']),
        ];
    }

    // Menampilkan seluruh daftar berita
    public function index()
    {
        // Mengambil semua berita dari yang paling baru
        $news = News::latest()->get();
        return view('news.index', compact('news'));
    }

    // Admin
    // Menampilkan form tambah berita 
    public function create()
    {
        return view('news.create');
    }

    // Menyimpan berita baru ke database
    public function store(Request $request)
    {
        // Validasi input wajib diisi
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $validated['admin_id'] = auth()->id();

        // Membuat data berita baru
        News::create($validated);
        return redirect()->route('news.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    // Menampilkan detail satu berita 
    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    // Menampilkan form edit berita 
    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
    }

    // Menyimpan perubahan data berita
    public function update(Request $request, News $news)
    {
        // Validasi data perubahan
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        // Memperbarui data ke database
        $news->update($validated);
        return redirect()->route('news.index')->with('success', 'Berita berhasil diupdate!');
    }

    // Menghapus data berita
    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('news.index')->with('success', 'Berita berhasil dihapus!');
    }
}