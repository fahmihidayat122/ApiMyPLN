@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Edit Informasi Pemadaman</h1>
    
    <div class="card">
        <div class="card-header bg-warning text-white">
            <h5 class="mb-0">Form Edit</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.informasi-pemadaman.update', $pemadaman->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="hari_tanggal">Hari/Tanggal</label>
                    <input type="date" name="hari_tanggal" id="hari_tanggal" class="form-control" value="{{ $pemadaman->hari_tanggal }}" required>
                </div>
                
                <div class="form-group">
                    <label for="waktu_mulai">waktu_mulai</label>
                    <input type="time" name="waktu_mulai" id="waktu_mulai" class="form-control" value="{{ $pemadaman->waktu_mulai }}" required>
                </div>

                <div class="form-group">
                    <label for="waktu_selesai">waktu_selesai</label>
                    <input type="time" name="waktu_selesai" id="waktu_selesai" class="form-control" value="{{ $pemadaman->waktu_selesai }}" required>
                </div>
                
                <div class="form-group">
                    <label for="lokasi_pemeliharaan">Lokasi Pemeliharaan</label>
                    <input type="text" name="lokasi_pemeliharaan" id="lokasi_pemeliharaan" class="form-control" value="{{ $pemadaman->lokasi_pemeliharaan }}" required>
                </div>
                
                <div class="form-group">
                    <label for="pekerjaan">Pekerjaan</label>
                    <textarea name="pekerjaan" id="pekerjaan" class="form-control" rows="3" required>{{ $pemadaman->pekerjaan }}</textarea>
                </div>
                
                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Perubahan</button>
                <a href="{{ route('admin.informasi-pemadaman.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
