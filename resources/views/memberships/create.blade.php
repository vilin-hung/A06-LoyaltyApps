<!DOCTYPE html>
<html>
<head>
    <title>Tambah Membership</title>
</head>
<body>

<!-- Halaman form untuk menambah tier membership -->
<h1>Tambah Tier Membership</h1>

<form action="{{ route('memberships.store') }}" method="POST">
    @csrf
    <!-- Input nama level -->
    <label>Nama Level (Contoh: Gold, Platinum):</label><br>
    <input type="text" name="level" value="{{ old('level') }}" required><br>
    @error('level')
        <div style="color:red">{{ $message }}</div>
    @enderror
    <br>

    <!-- Input minimal transaksi -->
    <label>Minimal Transaksi (Rp):</label><br>
    <input type="number" name="min_transaction" value="{{ old('min_transaction') }}" min="0" required><br>
    @error('min_transaction')
        <div style="color:red">{{ $message }}</div>
    @enderror
    <br>

    <!-- Input penggandaan poin -->
    <label>Pengganda Poin (Multiplier):</label><br>
    <input type="number" name="point_multiplier" value="{{ old('point_multiplier', 1) }}" min="1" required><br>
    <small>Contoh: Isi 2 jika level ini dapat poin 2x lipat.</small><br>
    @error('point_multiplier')
        <div style="color:red">{{ $message }}</div>
    @enderror
    <br>

    <!-- Input diskon otomatis -->
    <label>Diskon (%):</label><br>
    <input type="number" name="discount_percentage" value="{{ old('discount_percentage', 0) }}" min="0" max="100" required><br>
    @error('discount_percentage')
        <div style="color:red">{{ $message }}</div>
    @enderror
    <br>

    <!-- Input deskripsi tier membership -->
    <label>Deskripsi Tambahan:</label><br>
    <textarea name="description" rows="3">{{ old('description') }}</textarea><br>
    @error('description')
        <div style="color:red">{{ $message }}</div>
    @enderror
    <br>

    <button type="submit">
        Simpan Tier
    </button>
</form>

<br>
<a href="{{ route('memberships.index') }}">Kembali ke Daftar Membership</a>

</body>
</html>