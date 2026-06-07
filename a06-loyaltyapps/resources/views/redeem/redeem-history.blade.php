@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Redeem History</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Voucher</th>
                <th>Points Spent</th>
                <th>Date</th>
            </tr>
        </thead>

        <tbody>
            @forelse($redeems as $redeem)
                <tr>
                    <td>{{ $redeem->id }}</td>
                    <td>{{ $redeem->voucher->name ?? '-' }}</td>
                    <td>{{ $redeem->points_spent }}</td>
                    <td>{{ $redeem->created_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">
                        Belum ada riwayat redeem
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection