@extends('layouts.app')

@section('content')
<div class="container mt-5">
  <div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">Detail Voucher: {{ $voucher->name }}</h4>
    </div>
    <div class="card-body">
      <h5 class="text-uppercase fw-bold text-primary">{{ $voucher->code }}</h5>
      <p>{{ $voucher->description ?? 'Tidak ada deskripsi lengkap.' }}</p>
            
      <ul class="list-group mb-3">
        <li class="list-group-item"><strong>Diskon:</strong> {{ $voucher->discount_type == 'fixed' ? 'Rp ' . number_format($voucher->discount_value, 0, ',', '.') : $voucher->discount_value . '%' }}</li>
        <li class="list-group-item"><strong>Poin Dibutuhkan:</strong> {{ $voucher->points_required }}</li>
        <li class="list-group-item"><strong>Sisa Kuota:</strong> {{ $voucher->quota }}</li>
        <li class="list-group-item"><strong>Masa Aktif:</strong> {{ $voucher->start_date ?? '-' }} s/d {{ $voucher->end_date ?? '-' }}</li>
      </ul>

      <a href="{{ route('vouchers.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
  </div>
</div>
@endsection