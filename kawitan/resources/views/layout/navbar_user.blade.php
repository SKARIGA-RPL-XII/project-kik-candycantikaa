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
                            <a class="dropdown-item d-flex align-items-center p-2 text-danger" href="/login"
                                style="border-radius: 12px;">
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