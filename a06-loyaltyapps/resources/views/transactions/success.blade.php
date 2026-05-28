@extends('layouts.app') 

@section('content')
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6 text-center">
      <div class="card shadow-sm border-0">
        <div class="card-body py-5">
          <h1 class="display-4 text-success mb-3">
            <i class="bi bi-check-circle-fill"></i>
          </h1>
          <h2 class="mb-3">Transaksi Berhasil!</h2>
          <p class="text-muted mb-4">Terima kasih, pesananmu sedang kami proses.</p>

          <div class="bg-light p-3 rounded mb-4 text-start">
            <p class="mb-2">
              Diskon Tier: <span class="float-end fw-bold text-success">- Rp {{ number_format(session('discountNominal'), 0, ',', '.') }}</span>
            </p>
            <p class="mb-0">
              Poin Didapat: <span class="float-end fw-bold text-primary">+ {{ session('earnedPoints') }} Poin</span>
            </p>
          </div>

          <div class="d-grid gap-2 d-md-block">
            <a href="{{ route('transactions.history') }}" class="btn btn-outline-secondary px-4">Lihat Riwayat</a>
            <a href="{{ route('transactions.create') }}" class="btn btn-primary px-4">Belanja Lagi</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection