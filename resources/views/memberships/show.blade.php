<!DOCTYPE html>
<html>
<head>
    <title>Detail Membership</title>
</head>
<body>

<!-- Menampilkan detail informasi membership -->
<h1>Tier: {{ $membership->level }}</h1>
<p>
    <a href="{{ route('memberships.index') }}" class="btn">
        Kembali
    </a>
</p>
<p>Minimal Transaksi: Rp {{ number_format($membership->min_transaction, 0, ',', '.') }}</p>
<p>Bonus Poin (Multiplier): {{ $membership->point_multiplier }}x Lipat</p>
<p>Potongan Harga: {{ $membership->discount_percentage }}%</p>
<p>Description: {{ $membership->description ?? 'Tidak ada deskripsi lengkap untuk tier ini.' }}</p>

<hr>

@if(Auth::check() && auth()->user()->is_admin)
    <!-- Akses edit hanya untuk admin -->
    <a href="{{ route('memberships.edit', $membership->id) }}">
        Edit Tier
    </a>
@endif

</body>
</html>