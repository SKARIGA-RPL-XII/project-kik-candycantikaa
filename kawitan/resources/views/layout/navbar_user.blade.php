<div class="navbar-container">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <a class="navbar-brand d-flex align-items-center fw-800" href="{{ url('/dashboard_user') }}"
                style="text-decoration: none; padding: 0;">
                <div class="d-flex align-items-center justify-content-center" style="height: 40px;">
                    <img src="{{ asset('images/logo-tr.png') }}" alt="Logo Kawitan"
                        style="height: 35px; width: auto; object-fit: contain;" class="me-2">
                </div>

                <span class="align-middle" style="line-height: normal; margin-top: -2px;">
                    Kawitan - EcoPoint
                </span>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto fw-600">
                    <li class="nav-item">
                        <a class="nav-link px-3 {{ Request::is('dashboard_user') ? 'text-success fw-bold' : 'text-dark' }}"
                            style="color: #2c3e50 !important;" href="{{ url('/dashboard_user') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 {{ Request::is('riwayat_setor') ? 'text-success fw-bold' : 'text-dark' }}"
                            style="color: #2c3e50 !important;" href="{{ url('/riwayat_setor') }}">Riwayat Setor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 {{ Request::is('tukar_poin_user') ? 'text-success fw-bold' : 'text-dark' }}"
                            style="color: #2c3e50 !important;" href="{{ url('/tukar_poin_user') }}">Tukar Poin</a>
                    </li>
                </ul>

                <div class="dropdown">
                    <button class="btn btn-dark rounded-pill px-4 shadow-sm fw-bold btn-custom dropdown-toggle"
                        type="button" id="accountDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle me-1"></i> Akun Saya
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2 mt-3"
                        aria-labelledby="accountDropdown">
                        <li>
                            <a class="dropdown-item d-flex align-items-center p-2 mb-1" href="/profile"
                                style="border-radius: 12px;">
                                <div class="icon-circle me-2"
                                    style="width: 30px; height: 30px; background: #e8f5e9; color: #2e7d32; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                                <span class="fw-bold">Lihat Profil</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider opacity-50">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center p-2 text-danger" href="#"
                                data-bs-toggle="modal" data-bs-target="#logoutModal" style="border-radius: 12px;">

                                <div class="icon-circle me-2"
                                    style="width: 30px; height: 30px; background: #ffebee; color: #c62828; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-box-arrow-right"></i>
                                </div>

                                <span class="fw-bold">Keluar</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </div>
</div>

<div class="modal fade" id="logoutModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">

            <div class="modal-body text-center p-4">
                <i class="bi bi-box-arrow-right text-danger" style="font-size: 2rem;"></i>

                <h5 class="mt-3 fw-bold">Konfirmasi Keluar</h5>
                <p class="text-muted">Apakah Anda yakin ingin keluar dari aplikasi?</p>

                <div class="d-flex justify-content-center gap-2 mt-3">

                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger px-4">
                            Ya, Keluar
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>