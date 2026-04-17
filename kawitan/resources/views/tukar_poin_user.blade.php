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

        <div class="row g-3 mb-5">
            <div class="col-md-4">
                <div class="card card-custom shadow-sm stat-card-compact"
                    style="background: linear-gradient(135deg, #2ecc71, #27ae60); color: white; border: none;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <small class="fw-bold opacity-75">TOTAL SALDO</small>
                            <div class="d-flex align-items-baseline gap-2">
                                <h2 class="fw-800 mb-0">{{ number_format($saldo) }}</h2>
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
                            <h3 class="fw-800 text-success mb-0">+{{ number_format($poinMasuk) }}</h3>
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
                            <h3 class="fw-800 text-danger mb-0">-{{ number_format($poinKeluar) }}</h3>
                        </div>
                        <div class="icon-circle bg-danger-subtle">
                            <i class="bi bi-arrow-up-right text-danger fs-4"></i>
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
        </div>

        <div class="history-card-wrapper p-4 shadow-sm border-0 bg-white mb-5">
            @if($riwayatTukarAll->count() == 0)
                <div class="text-center py-5">
                    <i class="bi bi-box2-heart text-light d-block mb-3" style="font-size: 4rem;"></i>
                    <h5 class="fw-bold">Belum ada penukaran hadiah</h5>
                    <p class="text-muted small mb-0">Riwayat penukaran hadiah akan muncul di sini.</p>
                </div>
            @else
                @foreach($riwayatTukarAll->take(2) as $item)
                    <div class="history-item-card d-flex align-items-center justify-content-between p-3 rounded-4 bg-white shadow-sm border-start border-4 mb-3"
                        style="border-left-color: #2ecc71; cursor:pointer" data-bs-toggle="modal"
                        data-bs-target="#detailRiwayatModal" data-status="{{ $item->status }}"
                        data-hadiah="{{ $item->nama_hadiah }}" data-poin="{{ number_format($item->poin_dipakai) }}"
                        data-keterangan="{{ $item->keterangan }}">

                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-success-subtle text-success me-3 d-none d-md-flex">
                                <i class="bi bi-gift"></i>
                            </div>

                            <div>
                                <h6 class="fw-bold mb-1">{{ $item->nama_hadiah }}</h6>
                                <p class="text-muted small mb-0">
                                    {{ number_format($item->poin_dipakai) }} poin
                                </p>
                            </div>
                        </div>

                        @php
                            $status = strtolower($item->status);

                            if ($status == 'menunggu') {
                                $bg = 'bg-warning-subtle';
                                $text = 'text-warning';
                            } elseif ($status == 'ditolak') {
                                $bg = 'bg-danger-subtle';
                                $text = 'text-danger';
                            } else {
                                $bg = 'bg-success-subtle';
                                $text = 'text-success';
                            }
                        @endphp

                        <span class="badge {{ $bg }} {{ $text }} rounded-pill px-3 py-2 fw-bold small">
                            {{ strtoupper($item->status) }}
                        </span>
                    </div>
                @endforeach

                @if($riwayatTukarAll->count() > 2)
                    <div class="text-center mt-4">
                        <button class="btn btn-link text-success fw-bold text-decoration-none small" data-bs-toggle="modal"
                            data-bs-target="#allHistoryModal">
                            Lihat Riwayat Lainnya <i class="bi bi-chevron-down ms-1"></i>
                        </button>
                    </div>
                @endif
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
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="fw-bold mb-0">{{ $item->nama_hadiah }}</h6>
                                <span class="badge bg-light text-muted small">
                                    Stok {{ $item->stok }}
                                </span>
                            </div>

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
                                @php
                                    $status = strtolower($item->status);

                                    if ($status == 'menunggu') {
                                        $bg = 'bg-warning';
                                    } elseif ($status == 'ditolak') {
                                        $bg = 'bg-danger';
                                    } else {
                                        $bg = 'bg-success';
                                    }
                                @endphp

                                <span class="badge {{ $bg }} rounded-pill fw-bold" style="font-size: 0.7rem;">
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

    <div class="modal fade" id="detailRiwayatModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 24px;">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 pt-0 text-center">
                    <div id="statusIconWrapper" class="mx-auto mb-4 d-flex align-items-center justify-content-center"
                        style="width: 80px; height: 80px; border-radius: 50%;">
                        <i id="mainStatusIcon" class="bi fs-1"></i>
                    </div>

                    <h4 class="fw-800 mb-1" id="detailHadiah"></h4>
                    <p class="text-muted mb-4">Detail Penukaran Hadiah</p>

                    <div class="bg-light rounded-4 p-3 mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Status Transaksi</span>
                            <div id="detailStatus"></div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted small">Poin Digunakan</span>
                            <h5 class="fw-bold text-dark mb-0" id="detailPoin"></h5>
                        </div>
                    </div>

                    <div class="text-start mb-4">
                        <label class="small fw-bold text-muted mb-2 d-block">Keterangan / Pesan:</label>
                        <div class="p-3 bg-white border rounded-4">
                            <p id="detailKeterangan" class="small mb-0 text-secondary" style="line-height: 1.6;"></p>
                        </div>
                    </div>

                    <button class="btn btn-dark w-100 rounded-pill py-3 fw-bold shadow-sm" data-bs-dismiss="modal">
                        Mengerti
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const detailModal = document.getElementById('detailModal');

        if (detailModal) {
            detailModal.addEventListener('show.bs.modal', event => {
                const btn = event.relatedTarget;

                document.getElementById('modalHadiahId').value = btn.dataset.id;
                document.getElementById('modalName').innerText = btn.dataset.nama;
                document.getElementById('modalPoints').innerText = btn.dataset.poin;
                document.getElementById('modalImg').src = btn.dataset.img;
                document.getElementById('modalDesc').innerText = btn.dataset.desc;
            });
        }

        const detailRiwayatModal = document.getElementById('detailRiwayatModal');

        if (detailRiwayatModal) {
            detailRiwayatModal.addEventListener('show.bs.modal', function (event) {
                const btn = event.relatedTarget;

                const status = btn.dataset.status.toLowerCase();
                const hadiah = btn.dataset.hadiah;
                const poin = btn.dataset.poin;
                const keterangan = btn.dataset.keterangan;

                document.getElementById('detailHadiah').innerText = hadiah;
                document.getElementById('detailPoin').innerText = poin + ' Poin';

                const statusWrapper = document.getElementById('statusIconWrapper');
                const mainIcon = document.getElementById('mainStatusIcon');
                const detailStatus = document.getElementById('detailStatus');
                const detailKet = document.getElementById('detailKeterangan');

                if (status === 'menunggu') {
                    statusWrapper.className = "mx-auto mb-4 d-flex align-items-center justify-content-center bg-warning-subtle text-warning";
                    mainIcon.className = "bi bi-clock-history fs-1";
                    detailStatus.innerHTML = '<span class="badge bg-warning-subtle text-warning rounded-pill px-3">MENUNGGU</span>';
                    detailKet.innerText = 'Permintaan penukaran sedang diproses oleh admin. Mohon tunggu kabar selanjutnya.';
                }
                else if (status === 'ditolak') {
                    statusWrapper.className = "mx-auto mb-4 d-flex align-items-center justify-content-center bg-danger-subtle text-danger";
                    mainIcon.className = "bi bi-x-circle fs-1";
                    detailStatus.innerHTML = '<span class="badge bg-danger-subtle text-danger rounded-pill px-3">DITOLAK</span>';
                    detailKet.innerText = keterangan ? keterangan : 'Maaf, penukaran poin kamu tidak dapat diproses.';
                }
                else { 
                    statusWrapper.className = "mx-auto mb-4 d-flex align-items-center justify-content-center bg-success-subtle text-success";
                    mainIcon.className = "bi bi-check-circle-fill fs-1";
                    detailStatus.innerHTML = '<span class="badge bg-success-subtle text-success rounded-pill px-3">SELESAI</span>';
                    detailKet.innerText = 'Hore! Hadiah sudah bisa diambil di Bank Sampah Kawitan dengan menunjukkan riwayat ini.';
                }
            });
        }
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