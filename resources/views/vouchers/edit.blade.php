@extends('layouts.app')

@section('content')
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm border-0">
        <div class="card-body p-4">
          <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">Edit Voucher</h4>
            <form action="{{ route('vouchers.destroy', $voucher->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus voucher ini?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm">Hapus Voucher</button>
            </form>
          </div>
          
          <form action="{{ route('vouchers.update', $voucher->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Nama Voucher</label>
                <input type="text" name="name" class="form-control" value="{{ $voucher->name }}" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Kode Voucher (Unik)</label>
                <input type="text" name="code" class="form-control text-uppercase" value="{{ $voucher->code }}" required>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Deskripsi (Opsional)</label>
              <textarea name="description" class="form-control" rows="2">{{ $voucher->description }}</textarea>
            </div>

            <div class="row">
              <div class="col-md-4 mb-3">
                <label class="form-label">Tipe Diskon</label>
                <select name="discount_type" class="form-select" required>
                  <option value="fixed" {{ $voucher->discount_type == 'fixed' ? 'selected' : '' }}>Nominal Tetap (Rp)</option>
                  <option value="percentage" {{ $voucher->discount_type == 'percentage' ? 'selected' : '' }}>Persentase (%)</option>
                </select>
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Nilai Diskon</label>
                <input type="number" name="discount_value" class="form-control" value="{{ $voucher->discount_value }}" min="0" required>
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Poin Dibutuhkan</label>
                <input type="number" name="points_required" class="form-control" value="{{ $voucher->points_required }}" min="0" required>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4 mb-3">
                <label class="form-label">Kuota</label>
                <input type="number" name="quota" class="form-control" value="{{ $voucher->quota }}" min="0" required>
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Tanggal Mulai</label>
                <input type="datetime-local" name="start_date" class="form-control" value="{{ $voucher->start_date ? date('Y-m-d\TH:i', strtotime($voucher->start_date)) : '' }}">
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Tanggal Berakhir</label>
                <input type="datetime-local" name="end_date" class="form-control" value="{{ $voucher->end_date ? date('Y-m-d\TH:i', strtotime($voucher->end_date)) : '' }}">
              </div>
            </div>

            <div class="mb-4 form-check">
              <input type="checkbox" name="is_active" class="form-check-input" id="isActive" {{ $voucher->is_active ? 'checked' : '' }}>
              <label class="form-check-label" for="isActive">Voucher Aktif & Bisa Digunakan</label>
            </div>

            <div class="d-flex gap-2">
              <button type="submit" class="btn btn-primary px-4">Update</button>
              <a href="{{ route('vouchers.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
          </form>
          
        </div>
      </div>
    </div>
  </div>
</div>
@endsection