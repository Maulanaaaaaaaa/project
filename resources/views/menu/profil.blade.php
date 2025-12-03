<x-layouts.app title="Profil">

    <div class="container py-5">

        <div class="row justify-content-center">
            <div class="col-md-7">

                <div class="card shadow-lg border-0 rounded-4">

                    <div class="card-body p-4">

                        <div class="text-center mb-4">
                            <img src="{{ Auth::user()->avatar }}" class="rounded-circle shadow mb-2" width="120"
                                height="120" style="object-fit: cover;"
                                onerror="this.onerror=null; this.src='{{ asset('images/images1.png') }}';">
                            <h3 class="mt-3 mb-0">{{ Auth::user()->name }}</h3>
                            <p class="text-muted">{{ Auth::user()->email }}</p>
                        </div>

                        <hr>

                        <h5 class="fw-bold mb-3">Informasi Akun</h5>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->name }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="text" class="form-control" value="{{ Auth::user()->email }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tanggal Dibuat</label>
                            <input type="text" class="form-control"
                                value="{{ Auth::user()->created_at->format('d F Y') }}" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Login Via</label>
                            <input type="text" class="form-control"
                                value="{{ ucfirst($user->last_login_provider ?? 'Tidak diketahui') }}" disabled>
                        </div>

                           <div class="d-grid mt-4">
                            <a href="#" class="btn btn-primary rounded-pill py-2">
                                Edit Profil
                            </a>
                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>

</x-layouts.app>
