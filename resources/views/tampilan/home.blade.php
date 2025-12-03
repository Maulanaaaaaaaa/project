@extends('tampilan.app')

@section('title', 'Home')

@section('content')
    <!-- HERO SECTION -->
    <section class="hero">
        <div class="container">
            <h1 class="display-5 fw-bold">Selamat Datang di Aplikasi Anda</h1>
            <p class="lead mt-3">Tampilan home ini responsif, modern, dan mudah digunakan.</p>
            <a href="#features" class="btn btn-light btn-lg rounded-pill mt-3 px-4">Jelajahi</a>
        </div>
    </section>

    <!-- FEATURES SECTION -->
    <section id="features" class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-4">Fitur Utama</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="p-4 bg-white shadow-sm feature-card h-100">
                        <h5 class="fw-bold">Cepat dan Stabil</h5>
                        <p class="text-muted">Aplikasi dirancang dengan performa tinggi dan stabil.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-4 bg-white shadow-sm feature-card h-100">
                        <h5 class="fw-bold">User Friendly</h5>
                        <p class="text-muted">Navigasi mudah dan tampilan nyaman untuk semua pengguna.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-4 bg-white shadow-sm feature-card h-100">
                        <h5 class="fw-bold">Responsive</h5>
                        <p class="text-muted">Bisa diakses dengan baik melalui HP, tablet, maupun laptop.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
@endsection