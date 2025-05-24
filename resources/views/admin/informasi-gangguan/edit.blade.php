@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Edit Informasi Gangguan</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.informasi-gangguan.update', $gangguan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="hari_tanggal" class="form-label">Hari/Tanggal</label>
                    <input type="date" name="hari_tanggal" class="form-control" value="{{ old('hari_tanggal', $gangguan->hari_tanggal) }}" required>
                </div>

                <div class="mb-3">
                    <label for="waktu" class="form-label">Waktu</label>
                    <input type="time" name="waktu" class="form-control" value="{{ old('waktu', $gangguan->waktu) }}" required>
                </div>

                <div class="mb-3">
                    <label for="wilayah_pemeliharaan" class="form-label">Wilayah Pemeliharaan</label>
                    <input type="text" name="wilayah_pemeliharaan" class="form-control" value="{{ old('wilayah_pemeliharaan', $gangguan->wilayah_pemeliharaan) }}" required>
                </div>

                <div class="mb-3">
                    <label for="informasi_gangguan" class="form-label">Informasi Gangguan</label>
                    <textarea name="informasi_gangguan" class="form-control" required>{{ old('informasi_gangguan', $gangguan->informasi_gangguan) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="dampak_gangguan" class="form-label">Dampak Gangguan</label>
                    <textarea name="dampak_gangguan" class="form-control" required>{{ old('dampak_gangguan', $gangguan->dampak_gangguan) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="Belum Di Perbaiki" {{ $gangguan->status == 'Belum Di Perbaiki' ? 'selected' : '' }}>Belum Di Perbaiki</option>
                        <option value="Sedang Di Perbaiki" {{ $gangguan->status == 'Sedang Di Perbaiki' ? 'selected' : '' }}>Sedang Di Perbaiki</option>
                        <option value="Selesai Di Perbaiki" {{ $gangguan->status == 'Selesai Di Perbaiki' ? 'selected' : '' }}>Selesai Di Perbaiki</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                <a href="{{ route('admin.informasi-gangguan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
