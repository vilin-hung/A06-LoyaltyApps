<!DOCTYPE html>
<html>
<head>
    <title>Detail Membership</title>
    <style>
        .color_silver { color: #8e8e8e; font-weight: bold; }
        .color_gold { color: #d4af37; font-weight: bold; }
        .color_platinum { color: #504d49; font-weight: bold; }
    </style>
</head>
<body>

<!-- Menampilkan detail informasi membership -->
<h1>Tier: <span class="color_{{ strtolower($membership->level) }}">{{ $membership->level }}</span></h1>
<p>
    <a href="{{ route('memberships.index') }}" style="background: #4545a5; color: #fff6fd; border:none; padding:8px 16px; font-size: 14px; border-radius:6px; cursor:pointer; text-decoration: none; font-family: sans-serif;">
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