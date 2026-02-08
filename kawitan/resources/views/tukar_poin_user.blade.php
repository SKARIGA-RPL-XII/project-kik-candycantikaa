<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoBank - Katalog & Riwayat Tukar</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="body-user">
    @include('layout.navbar_user')

    <div class="container" style="margin-top: 130px; padding-bottom: 100px;">

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card stat-card bg-points-total shadow-sm p-4 h-100 border-0">
                    <small class="text-uppercase fw-bold opacity-75">Total Saldo Poin</small>
                    <h1 class="fw-800 mb-0 mt-2">2.450 <small class="fs-6">pts</small></h1>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card bg-white shadow-sm p-4 h-100 border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted text-uppercase fw-bold">Poin Masuk</small>
                            <h2 class="fw-800 mb-0 mt-1 text-success">+3.000</h2>
                        </div>
                        <div class="icon-circle bg-success-subtle">
                            <i class="bi bi-arrow-down-left text-success fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card bg-white shadow-sm p-4 h-100 border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted text-uppercase fw-bold">Poin Keluar</small>
                            <h2 class="fw-800 mb-0 mt-1 text-danger">-550</h2>
                        </div>
                        <div class="icon-circle bg-danger-subtle">
                            <i class="bi bi-arrow-up-right text-danger fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-12">
                <div class="card guide-card border-0 shadow-sm p-4 p-md-5">
                    <h4 class="fw-800 mb-1">Gampang Banget Tukar Poinnya!</h4>
                    <p class="text-muted small mb-5">Ikuti 3 langkah sederhana untuk klaim hadiah fisikmu.</p>

                    <div class="row g-4 justify-content-between text-center">
                        <div class="col-md-3">
                            <div class="icon-step shadow-sm mx-auto">
                                <div class="step-number-badge">1</div>
                                <i class="bi bi-hand-index-thumb"></i>
                            </div>
                            <h6 class="fw-bold">Pilih Hadiah</h6>
                            <p class="text-muted small">Cari hadiah fisik yang kamu suka di katalog.</p>
                        </div>
                        <div class="col-md-3">
                            <div class="icon-step shadow-sm mx-auto">
                                <div class="step-number-badge">2</div>
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <h6 class="fw-bold">Konfirmasi</h6>
                            <p class="text-muted small">Klik 'Lihat Detail' dan tukarkan poinmu.</p>
                        </div>
                        <div class="col-md-3">
                            <div class="icon-step shadow-sm mx-auto">
                                <div class="step-number-badge">3</div>
                                <i class="bi bi-box-seam"></i>
                            </div>
                            <h6 class="fw-bold">Ambil Hadiah</h6>
                            <p class="text-muted small">Hadiah siap diambil di titik EcoBank!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center mb-4">
            <h4 class="fw-800 mb-0">Riwayat Penukaran Hadiah</h4>
            <button class="btn btn-tertiary-primary btn-sm rounded-pill ms-auto fw-bold px-4" data-bs-toggle="modal"
                data-bs-target="#allHistoryModal">
                Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
            </button>
        </div>

        <div class="history-card-wrapper p-4 shadow-sm border-0 bg-white mb-5">
            @if(isset($riwayat_ada) && $riwayat_ada == false)
                <div class="text-center py-5">
                    <i class="bi bi-clock-history text-light d-block mb-3" style="font-size: 4rem;"></i>
                    <h5 class="fw-bold">Belum ada riwayat tukar</h5>
                    <p class="text-muted small mb-3">Poin yang kamu tukarkan akan muncul di sini.</p>
                    <a href="#katalog-hadiah" class="btn btn-success btn-sm rounded-pill px-4 fw-bold">Tukar Sekarang</a>
                </div>
            @else
                <div class="history-item-card d-flex align-items-center justify-content-between p-3 rounded-4 bg-white shadow-sm border-start border-4"
                    style="border-left-color: #f1c40f !important;">
                    <div class="d-flex align-items-center">
                        <div class="icon-circle bg-warning-subtle text-warning me-3 d-none d-md-flex">
                            <i class="bi bi-gift-fill"></i>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-1">Eco-Friendly Tumblr</h6>
                            <p class="text-muted small mb-0">12 Feb 2024 • 800 pts</p>
                        </div>
                    </div>
                    <span class="badge bg-warning-subtle text-warning-emphasis rounded-pill px-3 py-2 fw-bold small">
                        Siap Diambil
                    </span>
                </div>
            @endif
        </div>

        <div id="katalog-hadiah" class="d-flex justify-content-between align-items-end mb-4">
            <h4 class="fw-800 mb-0">Pilih Hadiah Fisik</h4>
            <span class="text-muted small">Tersedia 12 Produk</span>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-sm-6 col-lg-3">
                <div class="card reward-card border-0 shadow-sm h-100">
                    <div class="reward-img-wrapper">
                        <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&w=500" alt="Sembako">
                        <div class="badge-points shadow-sm">1.200 pts</div>
                    </div>
                    <div class="card-body p-4 text-center">
                        <h6 class="fw-bold mb-3">Paket Sembako Hemat</h6>
                        <button class="btn btn-dark w-100 rounded-pill py-2 fw-bold" data-bs-toggle="modal"
                            data-bs-target="#detailModal" data-name="Paket Sembako Hemat" data-points="1.200"
                            data-img="https://images.unsplash.com/photo-1542838132-92c53300491e?q=80&w=500"
                            data-desc="Beras 5kg, Minyak 1L, Gula 1kg. Ambil di Kantor EcoBank.">
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="allHistoryModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content shadow-lg">
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="modal-title fw-800">Semua Riwayat Penukaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="history-list-full">
                        <div
                            class="d-flex align-items-center justify-content-between p-3 mb-2 border rounded-4 bg-light">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check-circle-fill text-success fs-4 me-3"></i>
                                <div>
                                    <h6 class="fw-bold mb-0">Paket Sembako Hemat</h6>
                                    <small class="text-muted">05 Feb 2024 • 1.200 pts</small>
                                </div>
                            </div>
                            <span class="badge bg-success rounded-pill fw-bold"
                                style="font-size: 0.7rem;">SELESAI</span>
                        </div>
                    </div>
                </div>
                <!-- <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-secondary rounded-pill px-4 fw-bold"
                        data-bs-dismiss="modal">Tutup</button>
                </div> -->
            </div>
        </div>
    </div>

    <div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3 shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-800">Detail Hadiah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-start">
                    <div class="modal-img-container shadow-sm border">
                        <img src="" id="modalImg" alt="Reward">
                    </div>
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h4 class="fw-800 text-success mb-0" id="modalName"></h4>
                        <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2 fw-bold">
                            <span id="modalPoints"></span> Poin
                        </span>
                    </div>
                    <p class="text-muted mb-4 small" id="modalDesc"></p>

                    <div class="bg-light p-3 rounded-4 mb-4">
                        <div class="d-flex justify-content-between small">
                            <span class="text-muted">Status</span>
                            <span class="text-success fw-bold"><i class="bi bi-check-circle-fill me-1"></i>
                                Tersedia</span>
                        </div>
                    </div>

                    <button class="btn btn-success w-100 py-3 rounded-pill fw-bold shadow-sm"
                        onclick="alert('Poin berhasil ditukar!')">
                        Tukar Poin Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const detailModal = document.getElementById('detailModal')
        detailModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget
            detailModal.querySelector('#modalName').textContent = button.getAttribute('data-name')
            detailModal.querySelector('#modalPoints').textContent = button.getAttribute('data-points')
            detailModal.querySelector('#modalImg').src = button.getAttribute('data-img')
            detailModal.querySelector('#modalDesc').textContent = button.getAttribute('data-desc')
        })
    </script>
</body>

</html>