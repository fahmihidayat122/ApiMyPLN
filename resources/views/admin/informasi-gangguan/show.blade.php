@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Detail Informasi Gangguan</h1>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Hari/Tanggal</th>
                    <td>{{ \Carbon\Carbon::parse($gangguan->hari_tanggal)->format('d-m-Y') }}</td>
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
            </table>
            <div class="mt-4">
                <a href="{{ route('admin.informasi-gangguan.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
