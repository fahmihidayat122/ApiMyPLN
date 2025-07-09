@extends('layouts.admin')

@section('title', 'Edit Informasi Gangguan')

@section('content')
<div class="container">

    <div class="card shadow">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0"><i class="fas fa-edit me-2"></i> Form Edit Data Gangguan</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.informasi-gangguan.update', $gangguan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="hari_tanggal" class="form-label">Hari / Tanggal</label>
                    <input type="date" name="hari_tanggal" id="hari_tanggal"
                           class="form-control @error('hari_tanggal') is-invalid @enderror"
                           value="{{ old('hari_tanggal', $gangguan->hari_tanggal) }}" required>
                    @error('hari_tanggal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="waktu" class="form-label">Waktu</label>
                    <input type="time" name="waktu" id="waktu"
                           class="form-control @error('waktu') is-invalid @enderror"
                           value="{{ old('waktu', $gangguan->waktu) }}" required>
                    @error('waktu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="wilayah_pemeliharaan" class="form-label">Wilayah Pemeliharaan</label>
                    <input type="text" name="wilayah_pemeliharaan" id="wilayah_pemeliharaan"
                           class="form-control @error('wilayah_pemeliharaan') is-invalid @enderror"
                           value="{{ old('wilayah_pemeliharaan', $gangguan->wilayah_pemeliharaan) }}" required>
                    @error('wilayah_pemeliharaan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="informasi_gangguan" class="form-label">Informasi Gangguan</label>
                    <textarea name="informasi_gangguan" id="informasi_gangguan" rows="3"
                              class="form-control @error('informasi_gangguan') is-invalid @enderror"
                              required>{{ old('informasi_gangguan', $gangguan->informasi_gangguan) }}</textarea>
                    @error('informasi_gangguan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="dampak_gangguan" class="form-label">Dampak Gangguan</label>
                    <textarea name="dampak_gangguan" id="dampak_gangguan" rows="3"
                              class="form-control @error('dampak_gangguan') is-invalid @enderror"
                              required>{{ old('dampak_gangguan', $gangguan->dampak_gangguan) }}</textarea>
                    @error('dampak_gangguan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status"
                            class="form-control @error('status') is-invalid @enderror" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="Belum Di Perbaiki" {{ old('status', $gangguan->status) == 'Belum Di Perbaiki' ? 'selected' : '' }}>
                            Belum Di Perbaiki
                        </option>
                        <option value="Sedang Di Perbaiki" {{ old('status', $gangguan->status) == 'Sedang Di Perbaiki' ? 'selected' : '' }}>
                            Sedang Di Perbaiki
                        </option>
                        <option value="Selesai Di Perbaiki" {{ old('status', $gangguan->status) == 'Selesai Di Perbaiki' ? 'selected' : '' }}>
                            Selesai Di Perbaiki
                        </option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Simpan Perubahan
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
