<!DOCTYPE html>
<html>
<head>
    <title>Info Membership</title>
    <style>
        body { margin: 20px; color: #333;}
        
        /* Navigasi */
        .nav { margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid #ccc; }
        .nav_link { text-decoration: none; color: #4545a5; margin-right: 15px; font-weight: bold; }
        
        /* Box */
        .card { padding: 15px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 20px; }
        
        /* Warna Membership */
        .color_silver { color: #8e8e8e; font-weight: bold; }
        .color_gold { color: #d4af37; font-weight: bold; }
        .color_platinum { color: #504d49; font-weight: bold; }
        
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f3f4f6; }
    </style>
</head>
<body>

    <nav class="nav">
        <a href="{{ route('home') }}" class="nav_link">Beranda</a>
        <a href="{{ route('profile') }}" class="nav_link">Profil</a>
        <a href="{{ route('points') }}" class="nav_link">Poin</a>
        <a href="{{ route('saldo') }}" class="nav_link">Saldo</a>
        <a href="{{ route('membership.info') }}" class="nav_link">Membership</a>
        <a href="{{ route('logout') }}" class="nav_link" style="color: #cb4335;">Keluar</a>
    </nav>

    <h1>Info Membership</h1>

    <div class="card">
        <h2>
            Membership Saat Ini: 
            <span class="color_{{ strtolower(auth()->user()->membership->level ?? 'silver') }}">
                {{ auth()->user()->membership->level ?? 'Silver' }}
            </span>
        </h2>
        <p>Total Belanja Kamu: <strong>Rp {{ number_format(auth()->user()->total_spent, 0, ',', '.') }}</strong></p>
    </div>

    <h3>Keuntungan Tiap Tier Membership</h3>
    <table>
        <thead>
            <tr>
                <th>Tier</th>
                <th>Min. Transaksi</th>
                <th>Diskon</th>
                <th>Pengganda Poin</th>
            </tr>
        </thead>
        <tbody>
            @forelse($memberships as $tier)
                <tr style="text-align: center;">
                    <td style="font-weight: bold;">
                        <span class="color_{{ strtolower($tier->level) }}">
                            {{ $tier->level }}
                        </span>
                    </td>
                    <td>Rp {{ number_format($tier->min_transaction, 0, ',', '.') }}</td>
                    <td>
                        @if($tier->discount_percentage > 0)
                            <span style="font-weight: bold; color: red;">{{ $tier->discount_percentage }}% OFF</span>
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