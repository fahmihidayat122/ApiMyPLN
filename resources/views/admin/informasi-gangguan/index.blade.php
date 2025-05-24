@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Informasi Gangguan</h1>

    <a href="{{ route('admin.informasi-gangguan.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Informasi Gangguan
    </a>

    <div class="card">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">Daftar Informasi Gangguan</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Hari/Tanggal</th>
                            <th>Waktu</th>
                            <th>Wilayah Pemeliharaan</th>
                            <th>Informasi Gangguan</th>
                            <th>Dampak Gangguan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($gangguans as $gangguan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($gangguan->hari_tanggal)->translatedFormat('l, d F Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($gangguan->waktu)->format('H:i') }}</td>
                                <td>{{ $gangguan->wilayah_pemeliharaan }}</td>
                                <td>{{ $gangguan->informasi_gangguan }}</td>
                                <td>{{ $gangguan->dampak_gangguan }}</td>
                                <td>
                                    @if($gangguan->status === 'Belum Di Perbaiki')
                                        <span class="badge bg-danger">{{ $gangguan->status }}</span>
                                    @elseif($gangguan->status === 'Sedang Di Perbaiki')
                                        <span class="badge bg-warning text-dark">{{ $gangguan->status }}</span>
                                    @elseif($gangguan->status === 'Selesai Di Perbaiki')
                                        <span class="badge bg-success">{{ $gangguan->status }}</span>
                                    @else
                                        <span class="badge bg-secondary">Tidak Diketahui</span>
                                    @endif
                                </td>
                                <td>
                                    <!-- Tombol Detail -->
                                    <a href="{{ route('admin.informasi-gangguan.show', $gangguan->id) }}" 
                                       class="btn btn-info btn-sm" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <!-- Tombol Edit -->
                                    <a href="{{ route('admin.informasi-gangguan.edit', $gangguan->id) }}" 
                                       class="btn btn-warning btn-sm" title="Edit Informasi">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('admin.informasi-gangguan.destroy', $gangguan->id) }}" 
                                          method="POST" class="d-inline" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus informasi ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus Informasi">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        @if($gangguans->isEmpty())
                            <tr>
                                <td colspan="8" class="text-center text-muted">Belum ada informasi gangguan.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div> <!-- /table-responsive -->
        </div>
    </div>
</div>
@endsection
