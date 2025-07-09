@extends('layouts.admin')

@section('title', 'Informasi Gangguan')

@section('content')
<div class="container">

    <a href="{{ route('admin.informasi-gangguan.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Informasi Gangguan
    </a>

    <div class="card shadow">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0"><i class="nav-icon fas fa-exclamation-circle"></i> Daftar Informasi Gangguan</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Hari/Tanggal</th>
                            <th>Waktu</th>
                            <th>Wilayah</th>
                            <th>Informasi</th>
                            <th>Dampak</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($gangguans as $gangguan)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($gangguan->hari_tanggal)->translatedFormat('l, d F Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($gangguan->waktu)->format('H:i') }}</td>
                                <td>{{ $gangguan->wilayah_pemeliharaan }}</td>
                                <td>{{ Str::limit($gangguan->informasi_gangguan, 100) }}</td>
                                <td>{{ Str::limit($gangguan->dampak_gangguan, 100) }}</td>
                                <td class="text-center">
                                    @php
                                        $status = $gangguan->status;
                                        $badgeClass = match($status) {
                                            'Belum Di Perbaiki' => 'danger',
                                            'Sedang Di Perbaiki' => 'warning text-dark',
                                            'Selesai Di Perbaiki' => 'success',
                                            default => 'secondary'
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $badgeClass }}">{{ $status }}</span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.informasi-gangguan.show', $gangguan->id) }}"
                                       class="btn btn-info btn-sm" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.informasi-gangguan.edit', $gangguan->id) }}"
                                       class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.informasi-gangguan.destroy', $gangguan->id) }}"
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus informasi ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">Belum ada informasi gangguan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
