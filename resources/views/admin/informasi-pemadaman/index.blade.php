@extends('layouts.admin')

@section('title', 'Informasi Pemadaman')

@section('content')
<div class="container">

    <!-- Tombol Tambah Data -->
    <a href="{{ route('admin.informasi-pemadaman.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Informasi Pemadaman
    </a>

    <!-- Tabel Data Informasi Pemadaman -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-bolt me-2"></i> Daftar Pemadaman</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Hari / Tanggal</th>
                            <th>Waktu Mulai - Selesai</th>
                            <th>Lokasi Pemeliharaan</th>
                            <th>Pekerjaan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pemadamans as $pemadaman)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($pemadaman->hari_tanggal)->translatedFormat('l, d F Y') }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($pemadaman->waktu_mulai)->format('H:i') }} - 
                                    {{ \Carbon\Carbon::parse($pemadaman->waktu_selesai)->format('H:i') }}
                                </td>
                                <td>{{ $pemadaman->lokasi_pemeliharaan }}</td>
                                <td>{{ $pemadaman->pekerjaan }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.informasi-pemadaman.show', $pemadaman->id) }}" 
                                       class="btn btn-info btn-sm" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{ route('admin.informasi-pemadaman.edit', $pemadaman->id) }}" 
                                       class="btn btn-warning btn-sm" title="Edit Informasi">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('admin.informasi-pemadaman.destroy', $pemadaman->id) }}" 
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
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">Tidak ada data pemadaman saat ini.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
