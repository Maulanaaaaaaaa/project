<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'My App' }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">


    <style>
        body {
            overflow-x: hidden;
        }

        #sidebar {
            width: 250px;
            min-height: 100vh;
            background: #212529;
            transition: all 0.3s ease-in-out;
        }

        #sidebar.collapsed {
            margin-left: -250px;
        }

        #sidebar .nav-link {
            color: #adb5bd;
        }

        #sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        @media (max-width: 768px) {
            #sidebar {
                margin-left: -250px;
                position: fixed;
                z-index: 999;
            }

            #sidebar.show {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

    <x-partials.navbar />

    <div class="d-flex">
        <x-partials.sidebar />

        <div id="content" class="flex-grow-1 p-4">
            {{ $slot }}
        </div>
    </div>

    <x-partials.footer />

    <!-- ... script Bootstrap ... -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Tambahkan JS SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const mobileToggle = document.getElementById('mobileToggle');

        sidebarToggle?.addEventListener('click', () => sidebar.classList.toggle('collapsed'));
        mobileToggle?.addEventListener('click', () => sidebar.classList.toggle('show'));

        // 🚀 FIX untuk Facebook login (#_=_)
        if (window.location.hash === "#_=_") {
            history.replaceState(null, null, window.location.pathname + window.location.search);
        }

        // 🎉 Tampilkan SweetAlert jika ada pesan sukses
        @if (session('login_name') && session('login_provider'))
            Swal.fire({
                icon: 'success',
                title: 'Login Berhasil!',
                html: 'Halo <b>{{ session('login_name') }}</b> <span style="opacity:0.7;">({{ session('login_provider') }})</span>',
                showConfirmButton: false,
                timer: 2500
            });
        @endif


        // 💁‍♂️ (Opsional) Tampilkan SweetAlert jika ada pesan error
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
            });
        @endif
    </script>

</body>

</html>
