<!DOCTYPE html>
<html>
<head>
    <title>Tukar Voucher</title>
    <style>
        body { margin: 20px; color: #333; }
        .btn { padding: 8px 16px; border: none; border-radius: 6px; cursor: pointer; text-decoration: none; display: inline-block; font-size: 14px; }
        .btn_blue { background: #4545a5; color: #fff6fd; }
        .btn_green { background: #7b9e87; color: #fff6fd; }
        .btn_submit { display: block; margin-top: 15px; }
    </style>
</head>
<body>

    <h1>Tukar Voucher</h1>
    <p>
        <a href="{{ route('home') }}" class="btn btn_blue">Kembali ke Beranda</a>
        &nbsp;&nbsp;
        <a href="{{ route('redeems.index') }}" class="btn btn_green">Lihat Riwayat Redeem</a>
    </p>

    @if(session('error'))
        <p style="color: red;"><b>{{ session('error') }}</b></p>
    @endif

    <!-- Form untuk tukar voucher -->
    <form action="{{ route('redeems.store') }}" method="POST">
        @csrf
        <label>Pilih Voucher:</label><br>
        <select name="voucher_id" style="padding: 8px; width: 250px;">
            @foreach($vouchers as $voucher)
                <option value="{{ $voucher->id }}">
                    {{ $voucher->name }} (Kuota: {{ $voucher->quota }})
                </option>
            @endforeach
        </select>
        
        <button type="submit" class="btn btn_green btn_submit">Tukarkan</button>
    </form>
</body>
</html>