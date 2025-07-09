@extends('layouts.admin')

@section('title', 'Tambah Informasi Pemadaman')

@section('content')
<div class="container">

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i> Form Tambah Data</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.informasi-pemadaman.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="hari_tanggal" class="form-label">Hari / Tanggal</label>
                    <input type="date" name="hari_tanggal" class="form-control" value="{{ old('hari_tanggal') }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                        <input type="time" name="waktu_mulai" class="form-control" value="{{ old('waktu_mulai') }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                        <input type="time" name="waktu_selesai" class="form-control" value="{{ old('waktu_selesai') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="lokasi_pemeliharaan" class="form-label">Lokasi Pemeliharaan</label>
                    <input type="text" name="lokasi_pemeliharaan" class="form-control" value="{{ old('lokasi_pemeliharaan') }}" required>
                </div>

                <div class="mb-3">
                    <label for="pekerjaan" class="form-label">Pekerjaan</label>
                    <textarea name="pekerjaan" class="form-control" rows="3" required>{{ old('pekerjaan') }}</textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.informasi-pemadaman.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
