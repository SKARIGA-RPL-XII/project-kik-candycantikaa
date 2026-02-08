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
            <p class="lead opacity-90 fw-600">Dari sampah kecil, lahir perubahan besar untuk lingkungan dan masa depan.
            </p>
        </div>
    </section>

    <div class="container pb-5 impact-wrapper">

        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="card impact-card p-4 shadow-sm">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1 small fw-bold text-uppercase">CO₂ Dihemat</p>
                            <h4 class="fw-800 mb-0">100 kg</h4>
                        </div>
                        <div class="icon-circle" style="background: #e8f5e9; color: #2e7d32;"><i
                                class="bi bi-tree-fill"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card impact-card p-4 shadow-sm">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1 small fw-bold text-uppercase">Air Dihemat</p>
                            <h4 class="fw-800 mb-0">1.000 L</h4>
                        </div>
                        <div class="icon-circle" style="background: #e3f2fd; color: #1565c0;"><i
                                class="bi bi-droplet-fill"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card impact-card p-4 shadow-sm">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-muted mb-1 small fw-bold text-uppercase">kWh Dihemat</p>
                            <h4 class="fw-800 mb-0">2.5 kWh</h4>
                        </div>
                        <div class="icon-circle" style="background: #f3e5f5; color: #7b1fa2;"><i
                                class="bi bi-lightning-charge-fill"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm p-4 h-100 hover-card" style="border-radius: 30px;">
                    <h5 class="fw-bold mb-4">Status Penukaran</h5>

                    {{-- KONDISI: Jika ada transaksi yang sedang diproses --}}
                    @if(isset($transaksi_pending) && $transaksi_pending->count() > 0)
                        @foreach($transaksi_pending as $trx)
                            <div class="reward-waiting p-4 mb-3">
                                <div class="w-100 d-flex flex-column flex-md-row align-items-center justify-content-between">
                                    <div class="text-center text-md-start">
                                        <div class="mb-2">
                                            <span class="pulse-dot"></span>
                                            <span class="text-warning fw-bold small text-uppercase">Menunggu Konfirmasi</span>
                                        </div>
                                        <h5 class="fw-800 mb-1">{{ $trx->nama_hadiah }}</h5>
                                        <p class="text-muted mb-0 small">ID Transaksi: #{{ $trx->kode_transaksi }}</p>
                                    </div>
                                    <button
                                        class="btn btn-dark rounded-pill px-4 btn-sm mt-3 mt-md-0 shadow-sm btn-custom">Bantuan</button>
                                </div>
                            </div>
                        @endforeach

                        {{-- KONDISI: Jika TIDAK ADA transaksi --}}
                    @else
                        <div class="d-flex flex-column align-items-center justify-content-center py-4 text-center">
                            <div class="icon-circle mb-3"
                                style="width: 70px; height: 70px; background: #f8fafc; color: #cbd5e1; font-size: 2rem;">
                                <i class="bi bi-gift"></i>
                            </div>
                            <h6 class="fw-bold text-dark mb-1">Belum ada penukaran</h6>
                            <p class="text-muted small px-4">Poinmu masih utuh nih. Yuk, tukarkan dengan hadiah menarik
                                sekarang!</p>
                            <a href="/tukar_poin_user"
                                class="btn btn-sm btn-outline-success rounded-pill px-3 fw-bold mt-2">Cek Hadiah</a>
                        </div>
                    @endif

                </div>
            </div>

            <div class="col-lg-4">
                <div
                    class="card balance-card p-4 shadow-lg text-center h-100 d-flex flex-column justify-content-center">
                    <p class="small opacity-75 mb-1 fw-bold text-uppercase">Tabungan Poin</p>
                    <h1 class="fw-800 mb-4 display-5">2.450 <small class="fs-5 opacity-75">pts</small></h1>
                    <a href="/tukar_poin_user" class="btn btn-light btn-custom text-success shadow w-100 py-3 fw-bold">
                        <i class="bi bi-gift-fill me-2"></i>Tukar Sekarang
                    </a>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm p-4 hover-card" style="border-radius: 30px;">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold mb-0">Riwayat Setoran Terbaru</h5>
                        @if(isset($riwayat_setoran) && $riwayat_setoran->count() > 0)
                            <a href="/riwayat-setor" class="text-success fw-bold text-decoration-none small">Lihat Semua</a>
                        @endif
                    </div>

                    {{-- KONDISI: Jika sudah pernah setor --}}
                    @if(isset($riwayat_setoran) && $riwayat_setoran->count() > 0)
                        @foreach($riwayat_setoran as $setor)
                            <div
                                class="d-flex align-items-center p-3 rounded-4 bg-light border-start border-4 border-success list-item-hover mb-3">
                                <div class="fs-3 me-3 text-success"><i class="bi bi-box-seam"></i></div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 fw-bold">{{ $setor->jenis_sampah }}</h6>
                                    <small class="text-muted">{{ $setor->tanggal }} • {{ $setor->berat }} kg</small>
                                </div>
                                <div class="text-success fw-800">+{{ $setor->poin }} pts</div>
                            </div>
                        @endforeach

                        {{-- KONDISI: Jika belum pernah setor sama sekali --}}
                    @else
                        <div class="text-center py-4">
                            <div class="mb-3">
                                <i class="bi bi-recycle text-light-emphasis" style="font-size: 3rem;"></i>
                            </div>
                            <h6 class="fw-bold text-dark">Belum ada aktivitas setoran</h6>
                            <p class="text-muted small mb-3">Ayo bawa sampah anorganikmu ke titik pengumpulan<br>dan
                                kumpulkan poin pertamamu!</p>
                        </div>
                    @endif

                </div>
            </div>

            <div class="col-lg-4">
                <div class="card tips-card p-4 text-center hover-card h-100 d-flex flex-column justify-content-center">
                    <h6 class="fw-bold mb-3 text-success"><i class="bi bi-lightbulb-fill me-2"></i>Tips Hari Ini</h6>
                    <p class="small text-muted mb-0">"Bersihkan sisa makanan pada kemasan sebelum disetor ya, agar lebih
                        mudah didaur ulang!"</p>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>