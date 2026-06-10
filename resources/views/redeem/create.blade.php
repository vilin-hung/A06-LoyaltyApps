<!DOCTYPE html>
<html>
<head>
    <title>Tukar Voucher</title>
</head>

<br>
<a href="{{ route('home') }}">
    Kembali ke Beranda
</a>
<body>

<h1>Tukar Voucher</h1>

@if(session('error'))
    <p>{{ session('error') }}</p>
@endif

<form action="{{ route('redeems.store') }}" method="POST">
    @csrf

    <label>Voucher</label>
    <select name="voucher_id">
        @foreach($vouchers as $voucher)
            <option value="{{ $voucher->id }}">
                {{ $voucher->name }} (Kuota: {{ $voucher->quota }})
            </option>
        @endforeach
    </select>

    <br><br>

    <button type="submit">
        Tukarkan
    </button>
</form>

<br>

<a href="{{ route('redeems.index') }}">
    Lihat Riwayat Redeem
</a>

</body>
</html>