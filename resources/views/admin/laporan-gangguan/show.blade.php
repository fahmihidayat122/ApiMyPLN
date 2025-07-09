@extends('layouts.admin')

@section('title', 'Detail Laporan Gangguan')

@section('content')
<div class="container">

    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i> Detail Gangguan</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <tr>
                    <th style="width: 30%">No Handphone</th>
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

            <div class="mt-3">
                <a href="{{ route('admin.laporan-gangguan.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
