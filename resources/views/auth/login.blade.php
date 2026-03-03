@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-5">
            
            <div class="card border-0 shadow-lg" style="border-radius: 15px;">
                <div class="card-body p-5">
                    <div class="text-center">
                        <img src="https://kui.unida.ac.id/assets/images/logo/4e212e6d6ae69c042464c827a60a861e.png" alt="Logo" class="img-fluid" style="max-height: 80px;">
                        <h3 class=" fw-bold text-dark">Selamat Datang</h3>
                        <p class="text-muted">Silakan masuk ke akun Anda</p>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-2">
                            <label for="email" class="form-label fw-semibold text-secondary">{{ __('Alamat Email') }}</label>
                            <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus 
                                placeholder="nama@email.com" style="border-radius: 10px;">
                            
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <div class="d-flex justify-content-between">
                                <label for="password" class="form-label fw-semibold text-secondary">{{ __('Password') }}</label>
                                @if (Route::has('password.request'))
                                    <a class="text-decoration-none small" href="{{ route('password.request') }}">
                                        Lupa Password?
                                    </a>
                                @endif
                            </div>
                            <input id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                name="password" required autocomplete="current-password" 
                                placeholder="••••••••" style="border-radius: 10px;">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-grid shadow-sm">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold" style="border-radius: 10px; transition: 0.3s;">
                                {{ __('Masuk Sekarang') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background: #f8f9fa; /* Warna background abu-abu sangat muda */
    }
    .btn-primary {
        background-color: #4e73df;
        border: none;
    }
    .btn-primary:hover {
        background-color: #2e59d9;
        transform: translateY(-1px);
    }
    .form-control:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.1);
    }
</style>
@endsection