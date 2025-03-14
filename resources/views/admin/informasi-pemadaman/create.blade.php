@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Tambah Informasi Pemadaman</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.informasi-pemadaman.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="hari_tanggal">Hari/Tanggal</label>
                    <input type="date" name="hari_tanggal" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="waktu_mulai">Waktu Mulai</label>
                    <input type="time" name="waktu_mulai" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="waktu_selesai">Waktu Selesai</label> <!-- Perbaiki label -->
                    <input type="time" name="waktu_selesai" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="lokasi_pemeliharaan">Lokasi Pemeliharaan</label>
                    <input type="text" name="lokasi_pemeliharaan" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="pekerjaan">Pekerjaan</label>
                    <textarea name="pekerjaan" class="form-control" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.informasi-pemadaman.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
