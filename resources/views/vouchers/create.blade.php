<!DOCTYPE html>
<html>
<head>
    <title>Tambah Voucher</title>
</head>
<body>

<h1>Tambah Voucher</h1>

<form action="{{ route('vouchers.store') }}" method="POST">
    @csrf
    <!-- Input nama voucher -->
    <label>Nama Voucher:</label><br>
    <input type="text" name="name" value="{{ old('name') }}" required><br><br>
    @error('name')
        <div style="color: red; font-size: 14px; margin-top: 5px;">
            ⚠ {{ $message }}
        </div>
    @enderror
    <br>

    <!-- Input kode voucher -->
    <label>Kode Voucher:</label><br>
    <input type="text" name="code" value="{{ old('code', $voucher->code ?? '') }}" required><br>
    @error('code')
        <div style="color: red; font-size: 14px; margin-top: 5px;">
            ⚠ {{ $message }}
        </div>
    @enderror
    <br>

    <!-- Input deskripsi voucher -->
    <label>Deskripsi:</label><br>
    <textarea name="deskripsi"></textarea><br><br>

    <!-- Input tipe diskon -->
    <label>Tipe Diskon:</label><br>
    <select name="tipe_diskon" required>
        <option value="">-- Pilih Tipe Diskon --</option>
        <option value="fixed" {{ old('tipe_diskon') == 'fixed' ? 'selected' : '' }}>Nominal Tetap (Rp)</option>
        <option value="percentage" {{ old('tipe_diskon') == 'percentage' ? 'selected' : '' }}>Persentase (%)</option>
    </select>

    @error('tipe_diskon')
        <div style="color:red">{{ $message }}</div>
    @enderror
    
    <br><br>

    <!-- Input nilai diskon -->
    <label>Nilai Diskon:</label><br>
    <input type="number" name="nilai_diskon" min="0" required><br><br>

    <!-- Input poin yang dibutuhkan -->
    <label>Points yang Dibutuhkan:</label><br>
    <input type="number" name="points_yang_dibutuhkan" min="0" max="25" required><br><br>

    <!-- Input kuota voucher -->
    <label>Kuota:</label><br>
    <input type="number" name="kuota" min="0" required><br><br>

    <!-- Input tanggal mulai berlaku voucher -->
    <label>Tanggal Mulai:</label><br>
    <input type="datetime-local" name="tanggal_mulai"><br><br>

    <!-- Input tanggal masa berakhir voucher -->
    <label>Tanggal Berakhir:</label><br>
    <input type="datetime-local" name="tanggal_berakhir"><br><br>

    <!-- Input status voucher -->
    <label>Status:</label><br>
    <input type="checkbox" name="status" value="1" checked> Voucher Aktif<br><br>

    <button style="background: #7b9e87; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
    type="submit">
        Simpan
    </button>
</form>

<br>
<a href="{{ route('vouchers.index') }}" style="background: #4545a5; color: #fff6fd; border:none; padding:8px 16px; font-size: 14px; border-radius:6px; cursor:pointer; text-decoration: none; font-family: sans-serif;">
    Kembali ke Daftar Voucher
</a>

</body>
</html>