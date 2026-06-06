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
    <input type="text" name="name" required><br><br>

    <!-- Input kode voucher -->
    <label>Kode Voucher:</label><br>
    <input type="text" name="code" required><br><br>

    <!-- Input deskripsi voucher -->
    <label>Description:</label><br>
    <textarea name="description"></textarea><br><br>

    <!-- Input tipe diskon -->
    <label>Discount Type:</label><br>
    <select name="discount_type" required>
        <option value="">-- Pilih Tipe Diskon --</option>
        <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>Nominal Tetap (Rp)</option>
        <option value="percentage" {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>Persentase (%)</option>
    </select>

    @error('discount_type')
        <div style="color:red">{{ $message }}</div>
    @enderror
    
    <br><br>

    <!-- Input nilai diskon -->
    <label>Discount Value:</label><br>
    <input type="number" name="discount_value" min="0" required><br><br>

    <!-- Input poin yang dibutuhkan -->
    <label>Points Required:</label><br>
    <input type="number" name="points_required" min="0" required><br><br>

    <!-- Input kuota voucher -->
    <label>Quota:</label><br>
    <input type="number" name="quota" min="0" required><br><br>

    <!-- Input tanggal mulai berlaku voucher -->
    <label>Start Date:</label><br>
    <input type="datetime-local" name="start_date"><br><br>

    <!-- Input tanggal masa berakhir voucher -->
    <label>End Date:</label><br>
    <input type="datetime-local" name="end_date"><br><br>

    <!-- Input status voucher -->
    <label>Is Active:</label><br>
    <input type="checkbox" name="is_active" checked> Voucher Aktif<br><br>

    <button type="submit">
        Simpan
    </button>
</form>

<br>
<a href="{{ route('vouchers.index') }}">Kembali ke Daftar Voucher</a>

</body>
</html>