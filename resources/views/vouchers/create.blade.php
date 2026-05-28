@extends('layouts.app')

@section('content')
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm border-0">
        <div class="card-body p-4">
          <h4 class="mb-4 fw-bold">Tambah Voucher Baru</h4>
          
          <form action="{{ route('vouchers.store') }}" method="POST">
            @csrf
            
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Nama Voucher</label>
                <input type="text" name="name" class="form-control" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Kode Voucher (Unik)</label>
                <input type="text" name="code" class="form-control text-uppercase" required>
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label">Deskripsi (Opsional)</label>
              <textarea name="description" class="form-control" rows="2"></textarea>
            </div>

            <div class="row">
              <div class="col-md-4 mb-3">
                <label class="form-label">Tipe Diskon</label>
                <select name="discount_type" class="form-select" required>
                  <option value="fixed">Nominal Tetap (Rp)</option>
                  <option value="percentage">Persentase (%)</option>
                </select>
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Jumlah Diskon</label>
                <input type="number" name="discount_value" class="form-control" min="0" required>
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Poin yang dibutuhkan</label>
                <input type="number" name="points_required" class="form-control" min="0" required>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4 mb-3">
                <label class="form-label">Kuota</label>
                <input type="number" name="quota" class="form-control" min="0" required>
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Tanggal Mulai</label>
                <input type="datetime-local" name="start_date" class="form-control">
              </div>
              <div class="col-md-4 mb-3">
                <label class="form-label">Tanggal Berakhir</label>
                <input type="datetime-local" name="end_date" class="form-control">
              </div>
            </div>

            <div class="mb-4 form-check">
              <input type="checkbox" name="is_active" class="form-check-input" id="isActive" checked>
              <label class="form-check-label" for="isActive">Voucher Aktif & Bisa Digunakan</label>
            </div>

            <div class="d-flex gap-2">
              <button type="submit" class="btn btn-primary px-4">Simpan</button>
              <a href="{{ route('vouchers.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
          </form>
          
        </div>
      </div>
    </div>
  </div>
</div>
@endsection