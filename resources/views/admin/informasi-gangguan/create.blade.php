@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Tambah Informasi Gangguan</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.informasi-gangguan.store') }}" method="POST">

                @csrf
                {{-- <div class="mb-3">
                    <label for="laporan_gangguan_id" class="form-label">Pilih Laporan Gangguan</label>
                    <select class="form-control" id="laporan_gangguan_id" name="laporan_gangguan_id" required>
                        <option value="">-- Pilih Laporan --</option>
                        @foreach($laporanGangguans as $laporan)
                            <option value="{{ $laporan->id }}">{{ $laporan->id }}</option>
                        @endforeach
                    </select>
                </div> --}}

                <div class="mb-3">
                    <label for="hari_tanggal" class="form-label">Hari/Tanggal</label>
                    <input type="date" class="form-control" id="hari_tanggal" name="hari_tanggal" required>
                </div>

                <div class="mb-3">
                    <label for="waktu" class="form-label">Waktu</label>
                    <input type="time" class="form-control" id="waktu" name="waktu" required>
                </div>

                <div class="mb-3">
                    <label for="wilayah_pemeliharaan" class="form-label">Wilayah Pemeliharaan</label>
                    <input type="text" class="form-control" id="wilayah_pemeliharaan" name="wilayah_pemeliharaan" required>
                </div>

                <div class="mb-3">
                    <label for="informasi_gangguan" class="form-label">Informasi Gangguan</label>
                    <input type="text" class="form-control" id="informasi_gangguan" name="informasi_gangguan" required>
                </div>

                <div class="mb-3">
                    <label for="dampak_gangguan" class="form-label">Dampak Gangguan</label>
                    <input type="text" class="form-control" id="dampak_gangguan" name="dampak_gangguan" required>
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('admin.informasi-gangguan.index') }}" class="btn btn-secondary">Batal</a>

            </form>
        </div>
    </div>
</div>
@endsection
