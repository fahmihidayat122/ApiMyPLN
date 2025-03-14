@extends('layouts.admin')

@section('content')
<div class="small-box bg-info">
    <div class="inner">
        <h3>{{ $jumlahPengguna }}</h3>
        <p>Jumlah Pengguna</p>
    </div>
    <div class="icon">
        <i class="fas fa-users"></i>
    </div>
</div>

@endsection
