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
                    <h1 class="fw-800 mb-0 mt-2">
                        {{ number_format($saldo) }} <small class="fs-6">poin</small>
                    </h1>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card stat-card bg-white shadow-sm p-4 h-100 border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted text-uppercase fw-bold">Poin Masuk</small>
                            <h2 class="fw-800 mb-0 mt-1 text-success">
                                +{{ number_format($poinMasuk) }}
                            </h2>
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
                            <h2 class="fw-800 mb-0 mt-1 text-danger">
                                -{{ number_format($poinKeluar) }}
                            </h2>
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
                                <div class="step-number-badge">1</div> <i class="bi bi-hand-index-thumb"></i>
                            </div>
                            <h6 class="fw-bold">Pilih Hadiah</h6>
                            <p class="text-muted small">Cari hadiah fisik yang kamu suka di katalog.</p>
                        </div>
                        <div class="col-md-3">
                            <div class="icon-step shadow-sm mx-auto">
                                <div class="step-number-badge">2</div> <i class="bi bi-shield-check"></i>
                            </div>
                            <h6 class="fw-bold">Konfirmasi</h6>
                            <p class="text-muted small">Klik 'Lihat Detail' dan tukarkan poinmu.</p>
                        </div>
                        <div class="col-md-3">
                            <div class="icon-step shadow-sm mx-auto">
                                <div class="step-number-badge">3</div> <i class="bi bi-box-seam"></i>
                            </div>
                            <h6 class="fw-bold">Ambil Hadiah</h6>
                            <p class="text-muted small">Hadiah siap diambil di titik EcoBank!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center mb-4">
            <h4 class="fw-800 mb-0">Riwayat Tukar Hadiah</h4>
            <button class="btn btn-outline-success btn-sm rounded-pill ms-auto fw-bold px-4" data-bs-toggle="modal"
                data-bs-target="#allHistoryModal">
                Riwayat Lengkap <i class="bi bi-clock-history ms-1"></i>
            </button>
        </div>

        <div class="history-card-wrapper p-4 shadow-sm border-0 bg-white mb-5">
            @if($riwayatTukarLatest->count() == 0)
                <div class="text-center py-5">
                    <i class="bi bi-box2-heart text-light d-block mb-3" style="font-size: 4rem;"></i>
                    <h5 class="fw-bold">Belum ada penukaran hadiah</h5>
                    <p class="text-muted small mb-0">Riwayat penukaran hadiah akan muncul di sini.</p>
                </div>
            @else
                @foreach($riwayatTukarLatest as $item)
                    <div class="history-item-card d-flex align-items-center justify-content-between p-3 rounded-4 bg-white shadow-sm border-start border-4 mb-3"
                        style="border-left-color: #2ecc71">

                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-success-subtle text-success me-3 d-none d-md-flex">
                                <i class="bi bi-gift"></i>
                            </div>

                            <div>
                                <h6 class="fw-bold mb-1">
                                    {{ $item->nama_hadiah }}
                                </h6>
                                <p class="text-muted small mb-0">
                                    {{ number_format($item->poin_dipakai) }} poin
                                </p>
                            </div>
                        </div>

                        <span class="badge bg-success-subtle text-success-emphasis rounded-pill px-3 py-2 fw-bold small">
                            {{ strtoupper($item->status) }}
                        </span>

                    </div>
                @endforeach
            @endif
        </div>


        <div id="katalog-hadiah" class="d-flex justify-content-between align-items-end mb-4">
            <h4 class="fw-800 mb-0">Pilih Hadiah</h4>
        </div>

        <div class="row g-4 mb-5">
            @foreach($hadiah as $item)
                <div class="col-sm-6 col-lg-3">
                    <div class="card reward-card border-0 shadow-sm h-100">
                        <div class="reward-img-wrapper">
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_hadiah }}">
                            <div class="badge-points shadow-sm">
                                {{ number_format($item->poin_dibutuhkan) }} poin
                            </div>
                        </div>

                        <div class="card-body p-4 text-center">
                            <h6 class="fw-bold mb-3">{{ $item->nama_hadiah }}</h6>

                            <button class="btn btn-dark w-100 rounded-pill py-2 fw-bold" data-bs-toggle="modal"
                                data-bs-target="#detailModal" data-id="{{ $item->id_hadiah }}"
                                data-nama="{{ $item->nama_hadiah }}" data-poin="{{ $item->poin_dibutuhkan }}"
                                data-img="{{ asset('storage/' . $item->gambar) }}" data-desc="{{ $item->deskripsi }}">
                                Lihat Detail
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    <div class="modal fade" id="allHistoryModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content shadow-lg">
                <div class="modal-header border-0 p-4 pb-0">
                    <h5 class="modal-title fw-800">Semua Riwayat Tukar Hadiah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="history-list-full">
                        @foreach($riwayatTukarAll as $item)
                            <div
                                class="d-flex align-items-center justify-content-between p-3 mb-2 border rounded-4 bg-light">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-gift-fill text-success fs-4 me-3"></i>
                                    <div>
                                        <h6 class="fw-bold mb-0">
                                            {{ $item->nama_hadiah }}
                                        </h6>
                                        <small class="text-muted">
                                            {{ number_format($item->poin_dipakai) }} poin
                                        </small>
                                    </div>
                                </div>
                                <span class="badge bg-success rounded-pill fw-bold" style="font-size: 0.7rem;">
                                    {{ strtoupper($item->status) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="detailModal" tabindex="-1">
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
                            <span id="modalPoints"></span> poin
                        </span>
                    </div>

                    <p class="text-muted mb-4 small" id="modalDesc"></p>

                    <form action="{{ route('tukar.poin') }}" method="POST">
                        @csrf
                        <input type="hidden" name="hadiah_id" id="modalHadiahId">

                        <button type="submit" class="btn btn-success w-100 py-3 rounded-pill fw-bold shadow-sm">
                            Tukar Poin Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const detailModal = document.getElementById('detailModal');
        detailModal.addEventListener('show.bs.modal', event => {
            const btn = event.relatedTarget;
            document.getElementById('modalHadiahId').value = btn.dataset.id;
            document.getElementById('modalName').innerText = btn.dataset.nama;
            document.getElementById('modalPoints').innerText = btn.dataset.poin;
            document.getElementById('modalImg').src = btn.dataset.img;
            document.getElementById('modalDesc').innerText = btn.dataset.desc;
        });
    </script>

    @if(session('success'))
        <div class="modal fade" id="successModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-4 text-center">
                    <h5 class="fw-bold text-success">Berhasil</h5>
                    <p class="mb-3">{{ session('success') }}</p>
                    <button class="btn btn-success rounded-pill px-4" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>

        <script>
            new bootstrap.Modal(document.getElementById('successModal')).show();
        </script>
    @endif

    @if(session('error'))
        <div class="modal fade" id="errorModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-4 text-center">
                    <h5 class="fw-bold text-danger">Gagal</h5>
                    <p class="mb-3">{{ session('error') }}</p>
                    <button class="btn btn-danger rounded-pill px-4" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>

        <script>
            new bootstrap.Modal(document.getElementById('errorModal')).show();
        </script>
    @endif


</body>

</html>