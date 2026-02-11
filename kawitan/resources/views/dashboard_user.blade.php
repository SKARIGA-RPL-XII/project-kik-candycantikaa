<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoBank - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body class="body-user">

    @include('layout.navbar_user')

    <section class="hero-section text-center">
        <div class="container">
            <h1 class="hero-title mb-3">Setor Sampah, Selamatkan Bumi</h1>
            <p class="lead opacity-90 fw-600">Terima kasih atas kontribusimu menjaga lingkungan hari ini!</p>
        </div>
    </section>

    <div class="container pb-5 impact-wrapper">

        <div class="row g-3 mb-5">
            <div class="col-md-4">
                <div class="card card-custom shadow-sm stat-card-compact"
                    style="background: linear-gradient(135deg, #2ecc71, #27ae60); color: white; border: none;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <small class="fw-bold opacity-75">TOTAL SALDO</small>
                            <div class="d-flex align-items-baseline gap-2">
                                <h2 class="fw-800 mb-0">{{ number_format($saldo ?? 1200) }}</h2>
                                <small>poin</small>
                            </div>
                        </div>
                        <i class="bi bi-wallet2 fs-3 opacity-75"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-custom shadow-sm stat-card-compact bg-white border-start border-success border-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <small class="text-muted fw-bold">POIN MASUK</small>
                            <h3 class="fw-800 text-success mb-0">+{{ number_format($poinMasuk ?? 2450) }}</h3>
                        </div>
                        <div class="icon-circle bg-success-subtle">
                            <i class="bi bi-arrow-down-left text-success fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-custom shadow-sm stat-card-compact bg-white border-start border-danger border-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <small class="text-muted fw-bold">POIN KELUAR</small>
                            <h3 class="fw-800 text-danger mb-0">-{{ number_format($poinKeluar ?? 500) }}</h3>
                        </div>
                        <div class="icon-circle bg-danger-subtle">
                            <i class="bi bi-arrow-up-right text-danger fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card eco-outer-card shadow-sm p-3 mb-5">
            <div class="row g-4 align-items-center">
                <div class="col-lg-5">
                    <div class="eco-image-wrapper shadow-sm"></div>
                </div>

                <div class="col-lg-7">
                    <div class="ps-lg-3">
                        <h5 class="fw-800 mb-1">Dampak Positifmu</h5>
                        <p class="text-muted small mb-4">Setiap sampah yang kamu setor berkontribusi langsung pada
                            kelestarian alam secara nyata.</p>

                        <div class="impact-mini-card d-flex align-items-center">
                            <img src="https://cdn-icons-png.flaticon.com/512/3015/3015112.png" style="width: 35px;"
                                class="me-3">
                            <div>
                                <h6 class="fw-800 mb-0">100 kg CO₂</h6>
                                <p class="text-muted mb-0" style="font-size: 11px;">Berhasil mencegah emisi karbon
                                    di udara.</p>
                            </div>
                        </div>

                        <div class="impact-mini-card d-flex align-items-center">
                            <img src="https://cdn-icons-png.flaticon.com/512/3105/3105807.png" style="width: 35px;"
                                class="me-3">
                            <div>
                                <h6 class="fw-800 mb-0">1.000 L Air</h6>
                                <p class="text-muted mb-0" style="font-size: 11px;">Menghemat penggunaan air dalam
                                    proses produksi.</p>
                            </div>
                        </div>

                        <div class="impact-mini-card d-flex align-items-center">
                            <img src="https://cdn-icons-png.flaticon.com/512/3105/3105779.png" style="width: 35px;"
                                class="me-3">
                            <div>
                                <h6 class="fw-800 mb-0">2.5 kWh Energi</h6>
                                <p class="text-muted mb-0" style="font-size: 11px;">Energi yang dihemat dari proses
                                    daur ulang.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <div class="card card-custom shadow-sm p-4 equal-height"
                    style="background-color: #fff8f0; border-left: 5px solid #ff9f43 !important;">
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-lightbulb-fill text-warning fs-4 me-2"></i>
                        <h6 class="fw-800 mb-0">Tips Hari Ini</h6>
                    </div>
                    <p class="text-muted small mb-0">"Lipat dus karton sampai pipih sebelum disetor ya! Selain hemat
                        tempat, ini juga memudahkan petugas."</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-custom shadow-sm p-4 equal-height"
                    style="background-color: #f0f7ff; border-left: 5px solid #00d2d3 !important;">
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-info-circle-fill text-info fs-4 me-2"></i>
                        <h6 class="fw-800 mb-0">Tahukah Kamu?</h6>
                    </div>
                    <p class="text-muted small mb-0">Mendaur ulang 1 kaleng aluminium bisa menghemat energi untuk
                        menyalakan TV selama 3 jam.</p>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>