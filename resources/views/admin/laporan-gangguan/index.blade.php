@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Laporan Gangguan dari User</h1>

    <div class="card">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">Daftar Laporan Gangguan</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>No HP</th>
                            <th>No ID</th>
                            <th>Lokasi Gangguan</th>
                            <th>Deskripsi</th>
                            <th>Tanggal Laporan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($laporans as $laporan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $laporan->no_hp }}</td>
                                <td>{{ $laporan->no_id }}</td>
                                <td>{{ $laporan->lokasi_gangguan }}</td>
                                <td>{{ Str::limit($laporan->deskripsi_laporan, 50) }}</td>
                                <td>{{ \Carbon\Carbon::parse($laporan->created_at)->translatedFormat('d F Y') }}</td>
                                <td>
                                    <!-- Tombol Lihat Detail -->
                                    <a href="{{ route('admin.laporan-gangguan.show', $laporan->id) }}" 
                                       class="btn btn-info btn-sm" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('admin.laporan-gangguan.destroy', $laporan->id) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> <!-- /table-responsive -->
        </div>
    </div>
</div>
@endsection
