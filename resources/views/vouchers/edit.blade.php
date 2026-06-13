<!DOCTYPE html>
<html>
<head>
    <title>Edit Voucher</title>
</head>
<body>

<h1>Edit Voucher</h1>

<form action="{{ route('vouchers.update', $voucher->id) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Input nama voucher -->
    <label>Nama Voucher:</label><br>
    <input type="text" name="name" value="{{ $voucher->name }}" required><br><br>

    <!-- Input kode voucher -->
    <label>Kode Voucher:</label><br>
    <input type="text" name="code" value="{{ $voucher->code }}" required><br><br>

    <!-- Input deskripsi voucher -->
    <label>Deskripsi:</label><br>
    <textarea name="deskripsi">{{ $voucher->description }}</textarea><br><br>

    <!-- Input tipe diskon -->
    <label>Tipe Diskon:</label><br>
    <select name="tipe_diskon" required>
        <option value="fixed" {{ $voucher->tipe_diskon == 'fixed' ? 'selected' : '' }}>Nominal Tetap (Rp)</option>
        <option value="percentage" {{ $voucher->tipe_diskon == 'percentage' ? 'selected' : '' }}>Persentase (%)</option>
    </select><br><br>

    <!-- Input nilai diskon -->
    <label>Nilai Diskon:</label><br>
    <input type="number" name="nilai_diskon" value="{{ $voucher->discount_value }}" min="0" required><br><br>

    <!-- Input poin yang dibutuhkan -->
    <label>Poin yang Dibutuhkan:</label><br>
    <input type="number" name="points_yang_dibutuhkan" value="{{ $voucher->points_required }}" min="0" max="25" required><br><br>

    <!-- Input kuota voucher -->
    <label>Kuota:</label><br>
    <input type="number" name="kuota" value="{{ $voucher->quota }}" min="0" required><br><br>

    <!-- Input tanggal mulai berlaku voucher -->
    <label>Tanggal Mulai:</label><br>
    <input type="datetime-local" name="tanggal_mulai" value="{{ $voucher->start_date ? date('Y-m-d\TH:i', strtotime($voucher->start_date)) : '' }}"><br><br>

    <!-- Input tanggal masa berakhir voucher -->
    <label>Tanggal Berakhir:</label><br>
    <input type="datetime-local" name="tanggal_berakhir" value="{{ $voucher->end_date ? date('Y-m-d\TH:i', strtotime($voucher->end_date)) : '' }}"><br><br>

    <!-- Input status voucher -->
    <label>Status:</label><br>
    <input type="checkbox" name="status" {{ $voucher->is_active ? 'checked' : '' }}> Voucher Aktif<br><br>

    <button style="background: #7b9e87; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;"
    type="submit">
        Update
    </button>
</form>

<br>
<a href="{{ route('vouchers.index') }}" style="background: #4545a5; color: #fff6fd; border:none; padding:8px 16px; font-size: 14px; border-radius:6px; cursor:pointer; text-decoration: none; font-family: sans-serif;">
    Kembali ke Daftar Voucher
</a>

</body>
</html>