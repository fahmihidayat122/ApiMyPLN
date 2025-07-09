@extends('layouts.admin')

@section('title', 'Laporan Gangguan')

@section('content')
<div class="container">

    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-filter me-2"></i>Filter Laporan</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.laporan-gangguan.index') }}" method="GET">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label for="no_hp" class="form-label">No HP</label>
                        <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ request('no_hp') }}" placeholder="Masukkan No HP">
                    </div>
                    <div class="col-md-3">
                        <label for="no_id" class="form-label">No ID</label>
                        <input type="text" name="no_id" id="no_id" class="form-control" value="{{ request('no_id') }}" placeholder="Masukkan No ID">
                    </div>
                    <div class="col-md-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{ request('tanggal') }}">
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i> Cari
                        </button>
                        <a href="{{ route('admin.laporan-gangguan.index') }}" class="btn btn-secondary">
                            <i class="fas fa-undo"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0"><i class="fas fa-exclamation-triangle me-2"></i> Daftar Laporan Gangguan</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>No HP</th>
                            <th>No ID</th>
                            <th>Lokasi Gangguan</th>
                            <th>Deskripsi</th>
                            <th>Tanggal</th>
                            <th width="120px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporans as $laporan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $laporan->no_hp }}</td>
                                <td>{{ $laporan->no_id }}</td>
                                <td>{{ $laporan->lokasi_gangguan }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($laporan->deskripsi_laporan, 50) }}</td>
                                <td>{{ \Carbon\Carbon::parse($laporan->created_at)->translatedFormat('d F Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.laporan-gangguan.show', $laporan->id) }}" class="btn btn-info btn-sm" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.laporan-gangguan.destroy', $laporan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Tidak ada laporan yang ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
