@extends('layouts.admin')

@section('title', 'Detail Informasi Pemadaman')

@section('content')
<div class="container">

    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i> Detail Pemadaman</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th width="30%">Hari / Tanggal</th>
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

            <div class="mt-4">
                <a href="{{ route('admin.informasi-pemadaman.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
