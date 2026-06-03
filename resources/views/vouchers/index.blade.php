@extends('layouts.app')

@section('content')
<div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Daftar Voucher</h2>
    @if(auth()->user()->is_admin)
      <a href="{{ route('vouchers.create') }}" class="btn btn-primary">Tambah Voucher</a>
    @endif
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="row">
    @foreach($vouchers as $voucher)
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0 h-100 {{ !$voucher->is_active ? 'opacity-50' : '' }}">
          <div class="card-body position-relative">
            
            @if(!$voucher->is_active)
              <span class="badge bg-danger position-absolute top-0 end-0 m-3">Nonaktif</span>
            @endif

            <p class="text-uppercase fw-bold text-primary mb-1 small">{{ $voucher->code }}</p>
            <h5 class="card-title fw-bold">{{ $voucher->name }}</h5>
            
            <p class="text-muted mb-2 small">{{ $voucher->description ?? 'Tidak ada deskripsi' }}</p>

            <div class="bg-light p-2 rounded mb-3">
              <p class="mb-1 fw-bold text-success">
                Diskon: 
                @if($voucher->discount_type == 'fixed')
                  Rp {{ number_format($voucher->discount_value, 0, ',', '.') }}
                @else
                  {{ $voucher->discount_value }}%
                @endif
              </p>
              <p class="text-secondary small mb-0">Sisa Kuota: {{ $voucher->quota }}</p>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mt-auto">
              <span class="badge bg-warning text-dark px-3 py-2 border">{{ $voucher->points_required }} Poin</span>
              @if(!auth()->user()->is_admin)
                <form action="{{ route('redeem.store') }}" method="POST">
                  @csrf
                  <input type="hidden" name="voucher_id" value="{{ $voucher->id }}">
                  <button type="submit" class="btn btn-sm btn-success px-3" {{ ($voucher->quota <= 0 || !$voucher->is_active) ? 'disabled' : '' }}>
                    Tukarkan
                  </button>
                </form>
              @endif
            </div>
            @if(auth()->user()->is_admin)
              <div class="mt-3 border-top pt-3">
                <a href="{{ route('vouchers.edit', $voucher->id) }}" class="btn btn-sm btn-outline-primary w-100">Edit / Hapus Voucher</a>
              </div>
            @endif
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection