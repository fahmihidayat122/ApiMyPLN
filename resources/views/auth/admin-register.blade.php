@extends('layouts.auth')

@section('title', 'Registrasi Admin')

@section('content')
<div class="register-box">
    <div class="register-logo">
        <a href="#"><b>My</b> PLN</a>
    </div>

    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Registrasi Akun Admin</p>

            <form action="{{ route('admin.register') }}" method="POST">
                @csrf

                <div class="input-group mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Nama" value="{{ old('name') }}" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-user"></span></div>
                    </div>
                </div>
                @error('name')
                    <div class="text-danger mb-2 text-sm">{{ $message }}</div>
                @enderror

                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                    </div>
                </div>
                @error('email')
                    <div class="text-danger mb-2 text-sm">{{ $message }}</div>
                @enderror

                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                    </div>
                </div>
                @error('password')
                    <div class="text-danger mb-2 text-sm">{{ $message }}</div>
                @enderror

                <div class="input-group mb-3">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                    </div>
                </div>
            </form>

            <p class="mt-3 text-center">
                Sudah punya akun? <a href="{{ route('admin.login') }}">Login di sini</a>
            </p>
        </div>
    </div>
</div>
@endsection
