<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Redeem</title>
</head>
<body>

<h1>Riwayat Redeem</h1>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Voucher</th>
        <th>Poin</th>
    </tr>

    @foreach($redeems as $redeem)
    <tr>
        <td>{{ $redeem->id }}</td>
        <td>{{ $redeem->voucher->name }}</td>
        <td>{{ $redeem->points_spent }}</td>
    </tr>
    @endforeach

</table>

<br>

<a href="{{ route('redeems.create') }}">
    Tukar Voucher Lagi
</a>

</body>
</html>