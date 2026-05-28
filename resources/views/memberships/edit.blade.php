@extends('layouts.app')

@section('content')
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm">
        <div class="card-header bg-warning text-dark">
          <h5 class="mb-0">Edit Tier Membership: {{ $membership->level }}</h5>
        </div>
        <div class="card-body">
          <form action="{{ route('memberships.update', $membership->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
              <label class="form-label">Nama Level</label>
              <input type="text" name="level" class="form-control @error('level') is-invalid @enderror" value="{{ old('level', $membership->level) }}" required>
              @error('level') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
              <label class="form-label">Minimal Transaksi (Rp)</label>
              <input type="number" name="min_transaction" class="form-control @error('min_transaction') is-invalid @enderror" value="{{ old('min_transaction', $membership->min_transaction) }}" required min="0">
              @error('min_transaction') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Pengganda Poin (Multiplier)</label>
                <input type="number" name="point_multiplier" class="form-control @error('point_multiplier') is-invalid @enderror" value="{{ old('point_multiplier', $membership->point_multiplier) }}" required min="1">
                @error('point_multiplier') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>

              <div class="col-md-6 mb-3">
                <label class="form-label">Diskon Otomatis (%)</label>
                <input type="number" name="discount_percentage" class="form-control @error('discount_percentage') is-invalid @enderror" value="{{ old('discount_percentage', $membership->discount_percentage) }}" required min="0" max="100">
                @error('discount_percentage') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Deskripsi Tambahan</label>
              <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $membership->description) }}</textarea>
              @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="d-flex justify-content-end gap-2">
              <a href="{{ route('memberships.index') }}" class="btn btn-secondary">Batal</a>
              <button type="submit" class="btn btn-warning">Update Tier</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection