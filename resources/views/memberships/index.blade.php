@extends('layouts.app')

@section('content')
<div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Daftar Tier Membership</h2>
    @if(auth()->user()->is_admin)
      <a href="{{ route('memberships.create') }}" class="btn btn-primary">Tambah Tier</a>
    @endif
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="row">
    @foreach($memberships as $membership)
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0 h-100">
          <div class="card-header bg-dark text-white text-center py-3">
            <h4 class="mb-0 text-uppercase fw-bold">{{ $membership->level }}</h4>
          </div>
          <div class="card-body">
            <p class="text-muted text-center small mb-3">{{ $membership->description ?? 'Tidak ada deskripsi' }}</p>
            
            <ul class="list-group list-group-flush mb-3">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Min. Transaksi
                <strong>Rp {{ number_format($membership->min_transaction, 0, ',', '.') }}</strong>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Pengganda Poin
                <span class="badge bg-success rounded-pill">x{{ $membership->point_multiplier }}</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center">
                Diskon Khusus
                <strong>{{ $membership->discount_percentage }}%</strong>
              </li>
            </ul>

            @if(auth()->user()->is_admin)
              <div class="mt-auto border-top pt-3 d-flex gap-2">
                <a href="{{ route('memberships.edit', $membership->id) }}" class="btn btn-sm btn-outline-primary w-50">Edit</a>
                <form action="{{ route('memberships.destroy', $membership->id) }}" method="POST" class="w-50" onsubmit="return confirm('Yakin ingin menghapus tier ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-outline-danger w-100">Hapus</button>
                </form>
              </div>
            @endif
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection