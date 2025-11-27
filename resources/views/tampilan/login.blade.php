@extends('tampilan.app')

@section('title', 'Login')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4 p-md-5">

                        <div class="text-center mb-4">
                            <h2 class="fw-bold">Login</h2>
                            <p class="text-muted">Masuk ke akun Anda untuk melanjutkan</p>
                        </div>

                        {{-- Login dengan Google --}}
                        <div class="d-grid mb-3">
                            <a href="#" class="btn btn-light border shadow-sm rounded-pill py-2">
                                <img src="https://www.svgrepo.com/show/475656/google-color.svg"
                                    width="22" class="me-2" alt="Google">
                                Login dengan Google
                            </a>
                        </div>

                        {{-- Garis OR --}}
                        <div class="d-flex align-items-center mb-4">
                            <hr class="flex-grow-1">
                            <span class="px-3 text-muted">atau</span>
                            <hr class="flex-grow-1">
                        </div>

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="#" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">Email q</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input type="email" 
                                        class="form-control @error('email') is-invalid @enderror"
                                        id="email" 
                                        name="email" 
                                        placeholder="nama@example.com"
                                        value="{{ old('email') }}" 
                                        required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input type="password" 
                                        class="form-control @error('password') is-invalid @enderror"
                                        id="password" 
                                        name="password"
                                        placeholder="Masukkan password" 
                                        required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" 
                                       class="form-check-input" 
                                       id="remember" 
                                       name="remember">
                                <label class="form-check-label" for="remember">
                                    Ingat saya
                                </label>
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill">
                                    Login
                                </button>
                            </div>

                            <div class="text-center">
                                <p class="mb-0">
                                    Belum punya akun? 
                                    <a href="{{ route('register') }}" class="text-decoration-none">
                                        Daftar sekarang
                                    </a>
                                </p>
                                <p>
                                    <a href="#" class="text-decoration-none">
                                        Lupa password?
                                    </a>
                                </p>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" 
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        .card {
            border-radius: 16px;
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .input-group-text {
            background-color: #f8f9fa;
            border-right: none;
        }
        .form-control {
            border-left: none;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
            border-color: #86b7fe;
        }
        .btn-light:hover {
            background-color: #f1f1f1 !important;
        }
    </style>
@endpush
