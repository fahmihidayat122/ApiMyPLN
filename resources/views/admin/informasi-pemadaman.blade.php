@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Informasi Pemadaman</h1>

    <a href="" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Tambah Informasi Pemadaman
    </a>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Daftar Pemadaman</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Hari/Tanggal</th>
                        <th>Waktu</th>
                        <th>Lokasi Pemeliharaan</th>
                        <th>Pekerjaan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pemadamans as $pemadaman)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($pemadaman->hari_tanggal)->format('d-m-Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($pemadaman->waktu)->format('H:i') }}</td>
                            <td>{{ $pemadaman->lokasi_pemeliharaan }}</td>
                            <td>{{ $pemadaman->pekerjaan }}</td>
                            <td>
                                <a href="{{ route('admin.informasi-pemadaman.edit', $pemadaman->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.informasi-pemadaman.destroy', $pemadaman->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
