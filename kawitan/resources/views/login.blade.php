<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kawitan - EcoPoint Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="login d-flex justify-content-center align-items-center min-vh-100">

    <div class="container">
        <div class="login-card row g-0 shadow rounded overflow-hidden">

            <div class="col-md-6 login-image d-none d-md-block"></div>

            <div class="col-md-6 bg-white p-4 login-form">

                <div class="mb-4 d-flex align-items-center gap-2">
                    <img src="{{ asset('images/logo.png') }}" width="40">
                    <h5 class="mb-0 fw-bold">Kawitan - EcoPoint</h5>
                </div>

                <h2 class="fw-bold mb-2">Selamat Datang Kembali</h2>
                <p class="text-muted mb-4">
                    Silakan masuk untuk mengakses akun Anda.
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

                <form action="{{ route('login.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" placeholder="Masukkan Email Anda"
                            value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Kata Sandi <span class="text-danger">*</span></label>

                        <div class="input-group password-group">
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Masukkan Kata Sandi" required>

                            <span class="input-group-text password-toggle" onclick="togglePassword()">
                                <i id="eyeIcon" class="bi bi-eye"></i>
                            </span>
                        </div>
                    </div>



                    <button type="submit" class="btn btn-green w-100 py-2">
                        Masuk Sekarang
                    </button>

                    <div class="text-center mt-3">
                        <small class="text-muted">
                            Belum memiliki akun?
                            <a href="/register" class="fw-semibold text-decoration-none">Daftar</a>
                        </small>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('bi-eye');
                eyeIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('bi-eye-slash');
                eyeIcon.classList.add('bi-eye');
            }
        }
    </script>

</body>

</html>