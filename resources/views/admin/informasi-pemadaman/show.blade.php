@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Detail Informasi Pemadaman</h1>

    <div class="card">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Detail Pemadaman</h5>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>Hari/Tanggal</th>
                    <td>{{ \Carbon\Carbon::parse($pemadaman->hari_tanggal)->translatedFormat('l, d F Y') }}</td>
                </tr>
                <tr>
                    <th>Waktu Mulai</th>
                    <td>{{ \Carbon\Carbon::parse($pemadaman->waktu_mulai)->format('H:i') }}</td>
                </tr>
                <tr>
                    <th>Waktu Selesai</th>
                    <td>{{ \Carbon\Carbon::parse($pemadaman->waktu_selesai)->format('H:i') }}</td>
                </tr>
                <tr>
                    <th>Lokasi Pemeliharaan</th>
                    <td>{{ $pemadaman->lokasi_pemeliharaan }}</td>
                </tr>
                <tr>
                    <th>Pekerjaan</th>
                    <td>{{ $pemadaman->pekerjaan }}</td>
                </tr>
            </table>
            <a href="{{ route('admin.informasi-pemadaman.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection
