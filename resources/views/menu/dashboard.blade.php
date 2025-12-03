<x-layouts.app title="Portofolio Ahmad Fikri">

    {{-- Hero Section --}}
    <section id="home" class="pt-5 pb-5 text-center">
        <img src="/img/profile.jpg" class="rounded-circle shadow mb-3" width="150" alt="Profile">

        <h1 class="fw-bold">Hi, I'm <span class="text-primary">Ahmad Fikri</span></h1>
        <h4 class="text-muted">Full Stack Developer 🚀</h4>

        <p class="mt-3 text-secondary mx-auto" style="max-width: 550px;">
            Membangun aplikasi modern dengan pengalaman pengguna yang intuitif dan performa backend yang solid.
        </p>

        <div class="mt-4 d-flex justify-content-center gap-3">
            <a href="#projects" class="btn btn-primary btn-lg shadow">Lihat Proyek</a>
            <a href="#contact" class="btn btn-outline-dark btn-lg">Hubungi Saya</a>
        </div>

        {{-- Socials --}}
        <div class="d-flex justify-content-center gap-4 mt-4 fs-3">
            <a href="#" class="text-dark"><i class="bi bi-github"></i></a>
            <a href="#" class="text-primary"><i class="bi bi-linkedin"></i></a>
            <a href="#" class="text-danger"><i class="bi bi-envelope-fill"></i></a>
        </div>
    </section>

    {{-- Skills Section --}}
    <section id="skills" class="py-5 bg-light text-center">
        <h2 class="fw-bold mb-4">Technical Skills</h2>

        <div class="row g-4 justify-content-center">
            @foreach([
                ['Laravel', 'text-danger bi-layers'],
                ['React / Vue', 'text-primary bi-code-slash'],
                ['MySQL / PostgreSQL', 'text-info bi-database'],
                ['REST API', 'text-dark bi-diagram-3'],
                ['Tailwind / Bootstrap', 'text-success bi-ui-checks'],
            ] as $skill)
                <div class="col-6 col-md-3">
                    <div class="p-4 bg-white rounded shadow-sm h-100 d-flex flex-column justify-content-center">
                        <i class="bi {{ $skill[1] }} fs-2 mb-2"></i>
                        <strong>{{ $skill[0] }}</strong>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Projects Section --}}
    <section id="projects" class="py-5">
        <h2 class="fw-bold text-center mb-4">Project Unggulan</h2>

        <div class="row g-4 justify-content-center">
            @foreach([
                ['E-Commerce Dashboard', 'project1.png'],
                ['Sistem Manajemen HR', 'project2.png'],
                ['API Gateway Service', 'project3.png'],
            ] as $index => $project)
                <div class="col-md-4">
                    <div class="card shadow-sm h-100 border-0">
                        <img src="/img/{{ $project[1] }}" class="card-img-top" alt="{{ $project[0] }}">

                        <div class="card-body d-flex flex-column">
                            <h5 class="fw-bold">{{ $project[0] }}</h5>
                            <p class="text-muted small">Laravel + MySQL + Bootstrap</p>

                            <a href="#" class="btn btn-outline-primary mt-auto">
                                Detail Proyek
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Contact Section --}}
    <section id="contact" class="py-5 text-center bg-primary text-white">
        <h2 class="fw-bold mb-3">Tertarik bekerja sama?</h2>
        <p>Silakan hubungi saya melalui email atau LinkedIn</p>

        <a href="mailto:email@anda.com" class="btn btn-light btn-lg shadow">
            Kirim Email <i class="bi bi-envelope-fill ms-2"></i>
        </a>
    </section>

    
</x-layouts.app>
