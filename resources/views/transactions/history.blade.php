@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Riwayat Transaksi</h1>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if($transactions->isEmpty())
    <p>Belum ada transaksi.</p>
  @else
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Tanggal</th>
          <th>Total (Rp)</th>
          <th>Poin Didapat</th>
          <th>Detail</th>
        </tr>
      </thead>
      <tbody>
        @foreach($transactions as $transaction)
        <tr>
          <td>{{ $transaction->id }}</td>
          <td>{{ $transaction->created_at }}</td>
          <td>{{ number_format($transaction->total_amount) }}</td>
          <td>{{ $transaction->points_earned }}</td>
          <td>
            <ul>
            @foreach($transaction->items as $item)
              <li>{{ $item->product->name }} x{{ $item->quantity }} = Rp {{ number_format($item->price * $item->quantity) }}</li>
            @endforeach
            </ul>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  @endif
</div>
@endsection