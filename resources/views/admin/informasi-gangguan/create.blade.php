@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Tambah Informasi Gangguan</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.informasi-gangguan.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="hari_tanggal" class="form-label">Hari/Tanggal</label>
                    <input type="date" class="form-control @error('hari_tanggal') is-invalid @enderror"
                           id="hari_tanggal" name="hari_tanggal" value="{{ old('hari_tanggal') }}" required>
                    @error('hari_tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="waktu" class="form-label">Waktu</label>
                    <input type="time" class="form-control @error('waktu') is-invalid @enderror"
                           id="waktu" name="waktu" value="{{ old('waktu') }}" required>
                    @error('waktu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="wilayah_pemeliharaan" class="form-label">Wilayah Pemeliharaan</label>
                    <input type="text" class="form-control @error('wilayah_pemeliharaan') is-invalid @enderror"
                           id="wilayah_pemeliharaan" name="wilayah_pemeliharaan" value="{{ old('wilayah_pemeliharaan') }}" required>
                    @error('wilayah_pemeliharaan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="informasi_gangguan" class="form-label">Informasi Gangguan</label>
                    <textarea class="form-control @error('informasi_gangguan') is-invalid @enderror"
                              id="informasi_gangguan" name="informasi_gangguan" rows="3" required>{{ old('informasi_gangguan') }}</textarea>
                    @error('informasi_gangguan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="dampak_gangguan" class="form-label">Dampak Gangguan</label>
                    <textarea class="form-control @error('dampak_gangguan') is-invalid @enderror"
                              id="dampak_gangguan" name="dampak_gangguan" rows="3" required>{{ old('dampak_gangguan') }}</textarea>
                    @error('dampak_gangguan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                        <option value="Belum Di Perbaiki" {{ old('status') == 'Belum Di Perbaiki' ? 'selected' : '' }}>Belum Di Perbaiki</option>
                        <option value="Sedang Di Perbaiki" {{ old('status') == 'Sedang Di Perbaiki' ? 'selected' : '' }}>Sedang Di Perbaiki</option>
                        <option value="Selesai Di Perbaiki" {{ old('status') == 'Selesai Di Perbaiki' ? 'selected' : '' }}>Selesai Di Perbaiki</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('admin.informasi-gangguan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
