<!DOCTYPE html>
<html>
<head>
    <title>Info Membership</title>
    <style>
        .btn {
            padding: 5px 10px;
            text-decoration: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f2f2f2;
            color: black;
            font-size: 14px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h1>Info Membership</h1>
<p>
    <a href="{{ route('home') }}" class="btn">
        Kembali ke Beranda
    </a>
</p>

<br>

<h2>Membership Saat Ini: <span style="color: black;">{{ auth()->user()->membership->level ?? 'Silver' }}</span></h2>
<p>Total Belanja Kamu: <strong>Rp {{ number_format(auth()->user()->total_spent, 0, ',', '.') }}</strong></p>

<br>

<h3>Keuntungan Tiap Tier Membership</h3>

<table border="1" cellpadding="10" style="border-collapse: collapse;">
    <tr>
        <th>Tier</th>
        <th>Min. Transaksi</th>
        <th>Diskon</th>
        <th>Pengganda Poin</th>
    </tr>
    
    @forelse($memberships as $tier)
    <tr>
        <td><b>{{ $tier->level }}</b></td>
        <td>Rp {{ number_format($tier->min_transaction, 0, ',', '.') }}</td>
        <td>
            @if($tier->discount_percentage > 0)
                {{ $tier->discount_percentage }}% OFF
            @else
                -
            @endif
        </td>
        <td>
            @if($tier->point_multiplier > 1)
                {{ $tier->point_multiplier }}x Lipat
            @else
                Poin Standar
            @endif
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="4">Aturan membership belum ditambahkan oleh Admin.</td>
    </tr>
    @endforelse
</table>

</body>
</html>