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
    <label>Description:</label><br>
    <textarea name="description">{{ $voucher->description }}</textarea><br><br>

    <!-- Input tipe diskon -->
    <label>Discount Type:</label><br>
    <select name="discount_type" required>
        <option value="fixed" {{ $voucher->discount_type == 'fixed' ? 'selected' : '' }}>Nominal Tetap (Rp)</option>
        <option value="percentage" {{ $voucher->discount_type == 'percentage' ? 'selected' : '' }}>Persentase (%)</option>
    </select><br><br>

    <!-- Input nilai diskon -->
    <label>Discount Value:</label><br>
    <input type="number" name="discount_value" value="{{ $voucher->discount_value }}" min="0" required><br><br>

    <!-- Input poin yang dibutuhkan -->
    <label>Points Required:</label><br>
    <input type="number" name="points_required" value="{{ $voucher->points_required }}" min="0" required><br><br>

    <!-- Input kuota voucher -->
    <label>Quota:</label><br>
    <input type="number" name="quota" value="{{ $voucher->quota }}" min="0" required><br><br>

    <!-- Input tanggal mulai berlaku voucher -->
    <label>Start Date:</label><br>
    <input type="datetime-local" name="start_date" value="{{ $voucher->start_date ? date('Y-m-d\TH:i', strtotime($voucher->start_date)) : '' }}"><br><br>

    <!-- Input tanggal masa berakhir voucher -->
    <label>End Date:</label><br>
    <input type="datetime-local" name="end_date" value="{{ $voucher->end_date ? date('Y-m-d\TH:i', strtotime($voucher->end_date)) : '' }}"><br><br>

    <!-- Input status voucher -->
    <label>Is Active:</label><br>
    <input type="checkbox" name="is_active" {{ $voucher->is_active ? 'checked' : '' }}> Voucher Aktif<br><br>

    <button type="submit">
        Update
    </button>
</form>

<br>
<a href="{{ route('vouchers.index') }}">Kembali ke Daftar Voucher</a>

</body>
</html>