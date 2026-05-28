@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Redeem Voucher</h1>

    <form action="{{ route('redeem.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Voucher</label>

            <select name="voucher_id" class="form-control">
                @foreach($vouchers as $voucher)
                    <option value="{{ $voucher->id }}">
                        {{ $voucher->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Points Spent</label>

            <input type="number"
                   name="points_spent"
                   class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">
            Redeem
        </button>
    </form>
</div>
@endsection