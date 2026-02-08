<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoBank - Pengaturan Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="body-user" style="background-color: #f8fafc;">
    @include('layout.navbar_user')

    <div class="container" style="margin-top: 130px; padding-bottom: 100px;">
        <div class="profile-wrapper-clean">

            <div class="d-flex align-items-center mb-4 px-2">
                <h4 class="fw-800 mb-0" style="letter-spacing: -0.5px;">Pengaturan Profil</h4>
                <div class="ms-auto">
                    <span
                        class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-2">
                        <i class="bi bi-shield-check-fill me-1"></i> Akun Terverifikasi
                    </span>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success rounded-3">
                    <i class="bi bi-check-circle-fill me-1"></i>
                    {{ session('success') }}
                </div>
            @endif

            <div class="profile-card-clean shadow-sm">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf

                    <div class="row g-4">
                        <div class="col-12">
                            <label class="form-label-custom">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control form-control-custom"
                                value="{{ old('name', $user->username) }}" placeholder="Masukkan nama lengkap">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-custom">Alamat Email</label>
                            <input type="email" name="email" class="form-control form-control-custom"
                                value="{{ old('email', $user->email) }}" placeholder="email@anda.com">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-custom">Nomor Telepon</label>
                            <div class="input-group">
                                <span class="input-group-text border-0 bg-light px-3"
                                    style="border-radius: 15px 0 0 15px; font-weight: 700; color: #64748b;">+62</span>
                                <input type="text" name="phone" class="form-control form-control-custom"
                                    value="{{ old('phone', $user->tlpn) }}" style="border-radius: 0 15px 15px 0;">
                            </div>
                        </div>
                    </div>

                    <div class="section-divider">
                        <span class="section-title-inline">Keamanan Akun</span>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label-custom">Password Baru</label>
                            <div class="position-relative">
                                <input type="password" name="password" class="form-control form-control-custom"
                                    placeholder="Minimal 6 karakter">
                                <i
                                    class="bi bi-lock-fill position-absolute end-0 top-50 translate-middle-x text-muted opacity-50"></i>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label-custom">Konfirmasi Password Baru</label>
                            <div class="position-relative">
                                <input type="password" name="password_confirmation"
                                    class="form-control form-control-custom" placeholder="Ulangi password">
                                <i
                                    class="bi bi-shield-lock-fill position-absolute end-0 top-50 translate-middle-x text-muted opacity-50"></i>
                            </div>
                        </div>

                        <div class="col-12 mt-3">
                            <div class="p-3 rounded-3 bg-light border-start border-4 border-warning">
                                <small class="text-muted d-block">
                                    <i class="bi bi-exclamation-triangle-fill text-warning me-1"></i>
                                    Biarkan kolom password kosong jika Anda tidak ingin mengubahnya.
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 text-end">
                        <button type="button" class="btn btn-light px-4 py-3 rounded-pill fw-bold me-2">Batal</button>
                        <button type="submit" class="btn btn-success px-5 py-3 rounded-pill fw-bold shadow-sm">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>