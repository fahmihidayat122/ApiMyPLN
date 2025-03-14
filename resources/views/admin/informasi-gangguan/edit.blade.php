@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Edit Informasi Gangguan</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.informasi-gangguan.update', $gangguan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="hari_tanggal">Hari/Tanggal</label>
                    <input type="date" name="hari_tanggal" class="form-control" value="{{ $gangguan->hari_tanggal }}" required>
                </div>

                <div class="form-group">
                    <label for="waktu">Waktu</label>
                    <input type="time" name="waktu" class="form-control" value="{{ $gangguan->waktu }}" required>
                </div>

                <div class="form-group">
                    <label for="wilayah_pemeliharaan">Wilayah Pemeliharaan</label>
                    <input type="text" name="wilayah_pemeliharaan" class="form-control" value="{{ $gangguan->wilayah_pemeliharaan }}" required>
                </div>

                <div class="form-group">
                    <label for="informasi_gangguan">Informasi Gangguan</label>
                    <textarea name="informasi_gangguan" class="form-control" required>{{ $gangguan->informasi_gangguan }}</textarea>
                </div>

                <div class="form-group">
                    <label for="dampak_gangguan">Dampak Gangguan</label>
                    <textarea name="dampak_gangguan" class="form-control" required>{{ $gangguan->dampak_gangguan }}</textarea>
                </div>

                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                <a href="{{ route('admin.informasi-gangguan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
