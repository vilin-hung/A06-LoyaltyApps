@extends('layouts.app')

@section('content')
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
          <h5 class="mb-0">Tambah Tier Membership Baru</h5>
        </div>
        <div class="card-body">
          <form action="{{ route('memberships.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
              <label class="form-label">Nama Level (Contoh: Gold, Platinum)</label>
              <input type="text" name="level" class="form-control @error('level') is-invalid @enderror" value="{{ old('level') }}" required>
              @error('level') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Minimal Transaksi (Rp)</label>
              <input type="number" name="min_transaction" class="form-control @error('min_transaction') is-invalid @enderror" value="{{ old('min_transaction') }}" required min="0">
              @error('min_transaction') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Pengganda Poin (Multiplier)</label>
                <input type="number" name="point_multiplier" class="form-control @error('point_multiplier') is-invalid @enderror" value="{{ old('point_multiplier', 1) }}" required min="1">
                <div class="form-text">Contoh: Isi 2 jika level ini dapat poin 2x lipat.</div>
                @error('point_multiplier') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label">Diskon Otomatis (%)</label>
                <input type="number" name="discount_percentage" class="form-control @error('discount_percentage') is-invalid @enderror" value="{{ old('discount_percentage', 0) }}" required min="0" max="100">
                @error('discount_percentage') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Deskripsi Tambahan</label>
              <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description') }}</textarea>
              @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex justify-content-end gap-2">
              <a href="{{ route('memberships.index') }}" class="btn btn-secondary">Batal</a>
              <button type="submit" class="btn btn-primary">Simpan Tier</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection