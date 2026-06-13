<!DOCTYPE html>
<html>
<head>
    <title>Edit Membership</title>
    <style>
        .color_silver { color: #8e8e8e; font-weight: bold; }
        .color_gold { color: #d4af37; font-weight: bold; }
        .color_platinum { color: #504d49; font-weight: bold; }
    </style>
</head>
<body>

<!-- Halaman form untuk mengedit data membership -->
<h1>Edit Tier Membership: <span class="color_{{ strtolower($membership->level) }}">{{ $membership->level }}</span></h1>

<form action="{{ route('memberships.update', $membership->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <!-- Input nama level -->
    <label>Nama Level (Contoh: Gold, Platinum):</label><br>
    <input type="text" name="level" value="{{ old('level', $membership->level) }}" required><br>
    @error('level')
        <div style="color:red">{{ $message }}</div>
    @enderror
    <br>

    <!-- Input minimal transaksi -->
    <label>Minimal Transaksi (Rp):</label><br>
    <input type="number" name="min_transaction" value="{{ old('min_transaction', $membership->min_transaction) }}" min="0" required><br>
    @error('min_transaction')
        <div style="color:red">{{ $message }}</div>
    @enderror
    <br>

    <!-- Input penggandaan poin -->
    <label>Pengganda Poin (Multiplier):</label><br>
    <input type="number" name="point_multiplier" value="{{ old('point_multiplier', $membership->point_multiplier) }}" min="1" required><br>
    <small>Contoh: Isi 2 jika level ini dapat poin 2x lipat.</small><br>
    @error('point_multiplier')
        <div style="color:red">{{ $message }}</div>
    @enderror
    <br>

    <!-- Input diskon otomatis -->
    <label>Diskon (%):</label><br>
    <input type="number" name="discount_percentage" value="{{ old('discount_percentage', $membership->discount_percentage) }}" min="0" max="100" required><br>
    @error('discount_percentage')
        <div style="color:red">{{ $message }}</div>
    @enderror
    <br>

    <!-- Input deskripsi tier membership -->
    <label>Deskripsi Tambahan:</label><br>
    <textarea name="description" rows="3">{{ old('description', $membership->description) }}</textarea><br>
    @error('description')
        <div style="color:red">{{ $message }}</div>
    @enderror
    <br>

    <button style="background: #7b9e87; color: #fff6fd; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;" type="submit">
        Update Tier
    </button>
</form>

<br>
<a href="{{ route('memberships.index') }}" style="background: #4545a5; color: #fff6fd; border:none; padding:8px 16px; font-size: 14px; border-radius:6px; cursor:pointer; text-decoration: none; font-family: sans-serif;">
    Kembali ke Daftar Membership
</a>

</body>
</html>