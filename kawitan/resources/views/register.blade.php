<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kawitan - EcoPoint Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="d-flex justify-content-center align-items-center min-vh-100">

<div class="container m-5">
    <div class="login-card row g-0">
        <div class="col-md-6 login-image d-none d-md-block"></div>

        <div class="col-md-6 bg-white login-form">

            <div class="mb-4 d-flex align-items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" width="40">
                <h5 class="mb-0 fw-bold">Kawitan - EcoPoint</h5>
            </div>

            <h2 class="fw-bold mb-2">Selamat Datang</h2>
            <p class="text-muted mb-4">
                Daftar sekarang untuk mulai menggunakan layanan dengan aman.
            </p>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('register.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Pengguna <span class="text-danger">*</span></label>
                    <input type="text" name="username" class="form-control"placeholder ="Masukkan Nama Pengguna"
                        value="{{ old('username') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control"placeholder = "Masukkan Email"
                        value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">No. Telepon <span class="text-danger">*</span></label>
                    <input type="tel" name="tlpn" class="form-control"placeholder = "Masukkan No. Telepon"
                        value="{{ old('tlpn') }}" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Kata Sandi <span class="text-danger">*</span></label>

                    <div class="input-group password-group">
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control"
                            autocomplete="new-password"
                            placeholder="Masukkan Kata Sandi"
                            required
                        >
                        <span class="input-group-text password-toggle" onclick="togglePassword()">
                            <i id="eyePassword" class="bi bi-eye"></i>
                        </span>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Konfirmasi Kata Sandi <span class="text-danger">*</span></label>

                    <div class="input-group password-group">
                        <input
                            type="password"
                            name="password_confirmation"
                            id="password_confirmation"
                            class="form-control"
                            autocomplete="new-password"
                            placeholder="Konfirmasi Kata Sandi"
                            required
                        >
                        <span class="input-group-text password-toggle" onclick="toggleConfirmPassword()">
                            <i id="eyeConfirm" class="bi bi-eye"></i>
                        </span>
                    </div>
                </div>

                <button type="submit" class="btn btn-green w-100 py-2">
                    Daftar
                </button>

                <div class="text-center mt-3">
                    <small class="text-muted">
                        Sudah memiliki akun?
                        <a href="/login" class="fw-semibold text-decoration-none">Masuk</a>
                    </small>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
function togglePassword() {
    const input = document.getElementById('password');
    const icon = document.getElementById('eyePassword');

    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('bi-eye', 'bi-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('bi-eye-slash', 'bi-eye');
    }
}

function toggleConfirmPassword() {
    const input = document.getElementById('password_confirmation');
    const icon = document.getElementById('eyeConfirm');

    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('bi-eye', 'bi-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('bi-eye-slash', 'bi-eye');
    }
}
</script>

</body>
</html>
