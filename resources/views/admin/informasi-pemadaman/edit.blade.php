@extends('layouts.admin')

@section('title', 'Edit Informasi Pemadaman')

@section('content')
<div class="container">
    
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0"><i class="fas fa-edit me-2"></i> Form Edit Pemadaman</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.informasi-pemadaman.update', $pemadaman->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="hari_tanggal" class="form-label">Hari / Tanggal</label>
                    <input type="date" name="hari_tanggal" id="hari_tanggal" 
                           class="form-control" value="{{ old('hari_tanggal', $pemadaman->hari_tanggal) }}" required>
                </div>
                
                <div class="mb-3">
                    <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                    <input type="time" name="waktu_mulai" id="waktu_mulai" 
                           class="form-control" value="{{ old('waktu_mulai', $pemadaman->waktu_mulai) }}" required>
                </div>

                <div class="mb-3">
                    <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                    <input type="time" name="waktu_selesai" id="waktu_selesai" 
                           class="form-control" value="{{ old('waktu_selesai', $pemadaman->waktu_selesai) }}" required>
                </div>
                
                <div class="mb-3">
                    <label for="lokasi_pemeliharaan" class="form-label">Lokasi Pemeliharaan</label>
                    <input type="text" name="lokasi_pemeliharaan" id="lokasi_pemeliharaan" 
                           class="form-control" value="{{ old('lokasi_pemeliharaan', $pemadaman->lokasi_pemeliharaan) }}" required>
                </div>
                
                <div class="mb-3">
                    <label for="pekerjaan" class="form-label">Pekerjaan</label>
                    <textarea name="pekerjaan" id="pekerjaan" class="form-control" rows="3" required>{{ old('pekerjaan', $pemadaman->pekerjaan) }}</textarea>
                </div>
                
                <button type="submit" class="btn btn-success me-2">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.informasi-pemadaman.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Batal
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
