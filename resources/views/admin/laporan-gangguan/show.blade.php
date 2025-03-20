@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Detail Laporan Gangguan</h1>

    <div class="card">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Detail Gangguan</h5>
        </div>
        <div class="card-body">
            <table class="table">
                <tr>
                    <th>No Handphone</th>
                    <td>{{ $laporan->no_hp }}</td>
                </tr>
                <tr>
                    <th>No ID</th>
                    <td>{{ $laporan->no_id }}</td>
                </tr>
                <tr>
                    <th>Lokasi Gangguan</th>
                    <td>{{ $laporan->lokasi_gangguan }}</td>
                </tr>
                <tr>
                    <th>Deskripsi Laporan</th>
                    <td>{{ $laporan->deskripsi_laporan }}</td>
                </tr>
                <tr>
                    <th>Tanggal Laporan</th>
                    <td>{{ \Carbon\Carbon::parse($laporan->created_at)->translatedFormat('l, d F Y H:i') }}</td>
                </tr>
            </table>
            <a href="{{ route('admin.laporan-gangguan.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection
