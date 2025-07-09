@extends('layouts.auth')

@section('title', 'Login Admin')

@section('content')
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>My</b> PLN</a>
    </div>

    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Masuk sebagai admin</p>

            <form action="{{ route('admin.login.submit') }}" method="POST">
                @csrf

                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
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

                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </div>
                </div>
            </form>

            <p class="mt-3 text-center">
                Belum punya akun? <a href="{{ route('admin.register') }}">Daftar di sini</a>
            </p>
        </div>
    </div>
</div>
@endsection
