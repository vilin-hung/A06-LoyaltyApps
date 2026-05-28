@extends('layouts.app')

@section('content')
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white text-center py-4">
          <h2 class="mb-0 text-uppercase fw-bold">{{ $membership->level }}</h2>
          <p class="mb-0 mt-2 text-light">Detail Membership</p>
        </div>
        <div class="card-body p-4">
          <p class="text-center mb-4">{{ $membership->description ?? 'Tidak ada deskripsi lengkap untuk tier ini.' }}</p>
          
          <table class="table table-borderless">
            <tbody>
              <tr class="border-bottom">
                <th class="text-muted w-50">Minimal Transaksi</th>
                <td class="fw-bold">Rp {{ number_format($membership->min_transaction, 0, ',', '.') }}</td>
              </tr>
              <tr class="border-bottom">
                <th class="text-muted">Bonus Poin</th>
                <td class="fw-bold text-success">{{ $membership->point_multiplier }}x Lipat</td>
              </tr>
              <tr>
                <th class="text-muted">Potongan Harga</th>
                <td class="fw-bold">{{ $membership->discount_percentage }}%</td>
              </tr>
            </tbody>
          </table>

          <div class="text-center mt-4 border-top pt-4">
            <a href="{{ route('memberships.index') }}" class="btn btn-outline-secondary px-4">Kembali ke Daftar</a>
            @if(auth()->user()->is_admin)
              <a href="{{ route('memberships.edit', $membership->id) }}" class="btn btn-primary px-4 ms-2">Edit Tier</a>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection