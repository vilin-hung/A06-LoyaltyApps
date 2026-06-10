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
    <nav>
        <a href="{{ route('home') }}">Beranda</a> |
        <a href="{{ route('profile') }}">Profil</a> |
        <a href="{{ route('points') }}">Poin</a> |
        <a href="{{ route('saldo') }}">Saldo</a> |
        <a href="{{ route('membership.info') }}">Membership</a> |
        <a href="{{ route('logout') }}">Keluar</a>
    </nav>

<h1>Info Membership</h1>

<h2 style="margin-bottom: 10px;">
        Membership Saat Ini: 
        <span style="background-color: #e8f8f5; color: #117a65; padding: 4px 12px; border-radius: 6px; font-weight: bold; font-size: 24px;">
            {{ auth()->user()->membership->level ?? 'Silver' }}
        </span>
    </h2>
    <p style="font-size: 16px;">
        Total Belanja Kamu: <strong style="color: #4545a5; font-size: 18px;">Rp {{ number_format(auth()->user()->total_spent, 0, ',', '.') }}</strong>
    </p>

    <br>

    <h3 style="margin-bottom: 15px;">Keuntungan Tiap Tier Membership</h3>
    <table border="1" cellpadding="10" cellspacing="0" style="border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f3f4f6;">
                <th>Tier</th>
                <th>Min. Transaksi</th>
                <th>Diskon</th>
                <th>Pengganda Poin</th>
            </tr>
        </thead>
        <tbody>
            @forelse($memberships as $tier)
                <tr style="text-align:center">
                    <td style="font-weight: bold; text-align: left;">
                        <span style="background-color: #e8f8f5; color: #117a65; padding: 2px 6px; border-radius: 4px;">
                            {{ $tier->level }}
                        </span>
                    </td>
                    <td>Rp {{ number_format($tier->min_transaction, 0, ',', '.') }}</td>
                    <td>
                        @if($tier->discount_percentage > 0)
                            <span style="font-weight: bold;">{{ $tier->discount_percentage }}% OFF</span>
                        @else
                            <span style="color: gray;">-</span>
                        @endif
                    </td>
                    <td style="color: green; font-weight: bold;">
                        @if($tier->point_multiplier > 1)
                            {{ $tier->point_multiplier }}x Lipat
                        @else
                            Poin Standar
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="color: gray; font-style: italic;">Aturan membership belum ditambahkan oleh Admin.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>