@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Redeems</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Voucher</th>
                <th>Points</th>
            </tr>
        </thead>

        <tbody>
            @foreach($redeems as $redeem)
            <tr>
                <td>{{ $redeem->id }}</td>
                <td>{{ $redeem->user_id }}</td>
                <td>{{ $redeem->voucher_id }}</td>
                <td>{{ $redeem->points_spent }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection