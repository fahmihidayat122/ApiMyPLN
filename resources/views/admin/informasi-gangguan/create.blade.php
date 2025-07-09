@extends('layouts.admin')

@section('title', 'Tambah Informasi Gangguan')

@section('content')
<div class="container">

    <div class="card shadow">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0"><i class="fas fa-plus"></i> Formulir Tambah Informasi Gangguan</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.informasi-gangguan.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="hari_tanggal" class="form-label">Hari / Tanggal</label>
                    <input type="date" id="hari_tanggal" name="hari_tanggal"
                           class="form-control @error('hari_tanggal') is-invalid @enderror"
                           value="{{ old('hari_tanggal') }}" required>
                    @error('hari_tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="waktu" class="form-label">Waktu</label>
                    <input type="time" id="waktu" name="waktu"
                           class="form-control @error('waktu') is-invalid @enderror"
                           value="{{ old('waktu') }}" required>
                    @error('waktu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="wilayah_pemeliharaan" class="form-label">Wilayah Pemeliharaan</label>
                    <input type="text" id="wilayah_pemeliharaan" name="wilayah_pemeliharaan"
                           class="form-control @error('wilayah_pemeliharaan') is-invalid @enderror"
                           value="{{ old('wilayah_pemeliharaan') }}" required>
                    @error('wilayah_pemeliharaan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="informasi_gangguan" class="form-label">Informasi Gangguan</label>
                    <textarea id="informasi_gangguan" name="informasi_gangguan" rows="3"
                              class="form-control @error('informasi_gangguan') is-invalid @enderror"
                              required>{{ old('informasi_gangguan') }}</textarea>
                    @error('informasi_gangguan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="dampak_gangguan" class="form-label">Dampak Gangguan</label>
                    <textarea id="dampak_gangguan" name="dampak_gangguan" rows="3"
                              class="form-control @error('dampak_gangguan') is-invalid @enderror"
                              required>{{ old('dampak_gangguan') }}</textarea>
                    @error('dampak_gangguan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select id="status" name="status"
                            class="form-control @error('status') is-invalid @enderror" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="Belum Di Perbaiki" {{ old('status') == 'Belum Di Perbaiki' ? 'selected' : '' }}>
                            Belum Di Perbaiki
                        </option>
                        <option value="Sedang Di Perbaiki" {{ old('status') == 'Sedang Di Perbaiki' ? 'selected' : '' }}>
                            Sedang Di Perbaiki
                        </option>
                        <option value="Selesai Di Perbaiki" {{ old('status') == 'Selesai Di Perbaiki' ? 'selected' : '' }}>
                            Selesai Di Perbaiki
                        </option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('admin.informasi-gangguan.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
