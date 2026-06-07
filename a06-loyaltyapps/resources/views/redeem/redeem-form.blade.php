@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Redeem Voucher</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('redeem.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Voucher</label>

            <select name="voucher_id" class="form-control" required>
                @foreach($vouchers as $voucher)
                    <option value="{{ $voucher->id }}">
                        {{ $voucher->name }}
                        ({{ $voucher->points_required }} poin)
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Points Spent</label>

            <input
                type="number"
                name="points_spent"
                class="form-control"
                required
            >
        </div>

        <button type="submit" class="btn btn-primary">
            Redeem
        </button>
    </form>
</div>
@endsection