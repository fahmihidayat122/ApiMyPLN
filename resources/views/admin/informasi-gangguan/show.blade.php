@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Detail Informasi Gangguan</h1>

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Data Informasi</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th style="width: 30%;">Hari/Tanggal</th>
                    <td>{{ \Carbon\Carbon::parse($gangguan->hari_tanggal)->translatedFormat('l, d F Y') }}</td>
                </tr>
                <tr>
                    <th>Waktu</th>
                    <td>{{ \Carbon\Carbon::parse($gangguan->waktu)->format('H:i') }}</td>
                </tr>
                <tr>
                    <th>Wilayah Pemeliharaan</th>
                    <td>{{ $gangguan->wilayah_pemeliharaan }}</td>
                </tr>
                <tr>
                    <th>Informasi Gangguan</th>
                    <td>{{ $gangguan->informasi_gangguan }}</td>
                </tr>
                <tr>
                    <th>Dampak Gangguan</th>
                    <td>{{ $gangguan->dampak_gangguan }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        @if($gangguan->status == 'Belum Di Perbaiki')
                            <span class="badge bg-danger">{{ $gangguan->status }}</span>
                        @elseif($gangguan->status == 'Sedang Di Perbaiki')
                            <span class="badge bg-warning text-dark">{{ $gangguan->status }}</span>
                        @else
                            <span class="badge bg-success">{{ $gangguan->status }}</span>
                        @endif
                    </td>
                </tr>
            </table>

            <div class="mt-4">
                <a href="{{ route('admin.informasi-gangguan.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
