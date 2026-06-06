<!DOCTYPE html>
<html>
<head>
    <title>Detail Voucher</title>
</head>
<body>

<!-- Menampilkan detail informasi voucher -->
<h1>{{ $voucher->name }}</h1>
<p>
    <a href="{{ route('vouchers.index') }}" class="btn">
        Kembali
    </a>
</p>

<p>Kode: {{ $voucher->code }}</p>

<p>Diskon: 
    @if($voucher->discount_type == 'percentage')
        {{ $voucher->discount_value }}%
    @else
        Rp {{ number_format($voucher->discount_value, 0, ',', '.') }}
    @endif
</p>

<p>Points Required: {{ $voucher->points_required }}</p>
<p>Quota: {{ $voucher->quota }}</p>
<p>Description: {{ $voucher->description ?? 'Tidak ada deskripsi.' }}</p>

<p>Masa Aktif: 
    {{ $voucher->start_date ? \Carbon\Carbon::parse($voucher->start_date)->format('d M Y') : '-' }} 
    s/d 
    {{ $voucher->end_date ? \Carbon\Carbon::parse($voucher->end_date)->format('d M Y') : '-' }}
</p>

<hr>

<!-- Menampilkan syarat dan ketentuan penukaran voucher -->
<h2>Syarat & Ketentuan</h2>

<ul>
    <li>Penukaran voucher ini akan memotong saldo poin Anda sebesar <strong>{{ $voucher->points_required }} poin</strong>.</li>
    <li>Voucher hanya dapat digunakan selama masa aktif berlaku dan kuota masih tersedia.</li>
    <li>Voucher yang sudah ditukarkan tidak dapat dikembalikan menjadi poin.</li>
    <li>Status Voucher: <strong>{{ $voucher->is_active ? 'Aktif' : 'Nonaktif' }}</strong></li>
</ul>

</body>
</html>