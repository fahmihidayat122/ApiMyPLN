@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Informasi Pemadaman</h1>

    <!-- Tombol Tambah Data -->
    <a href="{{ route('admin.informasi-pemadaman.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Informasi Pemadaman
    </a>

    <!-- Tabel Data Informasi Pemadaman -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Daftar Pemadaman</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive"> <!-- Menambahkan responsivitas -->
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>No</th>
                            <th>Hari/Tanggal</th>
                            <th>Waktu Mulai dan Selesai</th>
                            <th>Lokasi Pemeliharaan</th>
                            <th>Pekerjaan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pemadamans as $pemadaman)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($pemadaman->hari_tanggal)->translatedFormat('l / d F Y') }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($pemadaman->waktu_mulai)->format('H:i') }} s.d 
                                    {{ \Carbon\Carbon::parse($pemadaman->waktu_selesai)->format('H:i') }}
                                </td>
                                <td>{{ $pemadaman->lokasi_pemeliharaan }}</td>
                                <td>{{ $pemadaman->pekerjaan }}</td>
                                <td>
                                    <!-- Tombol Detail -->
                                    <a href="{{ route('admin.informasi-pemadaman.show', $pemadaman->id) }}" 
                                        class="btn btn-info btn-sm" title="Lihat Detail">
                                         <i class="fas fa-eye"></i>
                                     </a>
 
                                     <!-- Tombol Edit -->
                                     <a href="{{ route('admin.informasi-pemadaman.edit', $pemadaman->id) }}" 
                                        class="btn btn-warning btn-sm" title="Edit Informasi">
                                         <i class="fas fa-edit"></i>
                                     </a>
 
                                     <!-- Tombol Hapus -->
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
                        @endforeach
                    </tbody>
                </table>
            </div> <!-- End of .table-responsive -->
        </div>
    </div>
</div>
@endsection
