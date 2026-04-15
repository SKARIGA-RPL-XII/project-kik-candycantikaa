<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoBank - Riwayat Setor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="body-user" style="background-color: #f8fafc; font-family: 'Plus Jakarta Sans', sans-serif;">
    @include('layout.navbar_user')

    <div class="container" style="margin-top: 130px; padding-bottom: 100px;">

        <div class="row mb-5">
            <div class="col-12">
                <div class="card guide-card border-0 shadow-sm p-4 p-md-5" style="border-radius: 30px;">
                    <div class="row mb-4">
                        <div class="col-12 text-center text-md-start">
                            <h4 class="fw-800 mb-1">Cara Setor Sampah</h4>
                            <p class="text-muted small">Ikuti 4 langkah mudah untuk mulai menabung poin!</p>
                        </div>
                    </div>

                    <div class="row g-4 justify-content-center">
                        <div class="col-6 col-md-3 text-center step-item">
                            <div class="icon-step shadow-sm mx-auto mb-3"
                                style="background: #e8f5e9; color: #2e7d32; width: 70px; height: 70px; border-radius: 20px; position: relative; font-size: 1.8rem;">
                                <div class="step-number-badge"
                                    style="position: absolute; top: -5px; right: -5px; background: #2e7d32; color: white; width: 25px; height: 25px; border-radius: 50%; font-size: 0.8rem; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                                    1</div>
                                <i class="bi bi-recycle"></i>
                            </div>
                            <h6 class="fw-bold mb-1">Pilah Sampah</h6>
                            <p class="text-muted small d-none d-md-block px-2">Pilah sampah dari rumah terlebih dahulu.
                            </p>
                        </div>

                        <div class="col-6 col-md-3 text-center step-item">
                            <div class="icon-step shadow-sm mx-auto mb-3"
                                style="background: #e3f2fd; color: #1565c0; width: 70px; height: 70px; border-radius: 20px; position: relative; font-size: 1.8rem;">
                                <div class="step-number-badge"
                                    style="position: absolute; top: -5px; right: -5px; background: #1565c0; color: white; width: 25px; height: 25px; border-radius: 50%; font-size: 0.8rem; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                                    2</div>
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <h6 class="fw-bold mb-1">Bawa Ke Bank</h6>
                            <p class="text-muted small d-none d-md-block px-2">Kunjungi Bank Sampah Kawitan.</p>
                        </div>

                        <div class="col-6 col-md-3 text-center step-item">
                            <div class="icon-step shadow-sm mx-auto mb-3"
                                style="background: #fff3e0; color: #ef6c00; width: 70px; height: 70px; border-radius: 20px; position: relative; font-size: 1.8rem;">
                                <div class="step-number-badge"
                                    style="position: absolute; top: -5px; right: -5px; background: #ef6c00; color: white; width: 25px; height: 25px; border-radius: 50%; font-size: 0.8rem; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                                    3</div>
                                <i class="bi bi-clipboard-check"></i>
                            </div>
                            <h6 class="fw-bold mb-1">Verifikasi</h6>
                            <p class="text-muted small d-none d-md-block px-2">Admin akan menimbang & input data.</p>
                        </div>

                        <div class="col-6 col-md-3 text-center step-item">
                            <div class="icon-step shadow-sm mx-auto mb-3"
                                style="background: #f3e5f5; color: #7b1fa2; width: 70px; height: 70px; border-radius: 20px; position: relative; font-size: 1.8rem;">
                                <div class="step-number-badge"
                                    style="position: absolute; top: -5px; right: -5px; background: #7b1fa2; color: white; width: 25px; height: 25px; border-radius: 50%; font-size: 0.8rem; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                                    4</div>
                                <i class="bi bi-wallet2"></i>
                            </div>
                            <h6 class="fw-bold mb-1">Cek Poin</h6>
                            <p class="text-muted small d-none d-md-block px-2">Poin masuk ke riwayat setoran.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="history-title-wrapper d-flex align-items-center mb-4">
            <h4 class="fw-800 mb-0">Riwayat Setoran</h4>
            @if(isset($riwayat_setoran) && $riwayat_setoran->count() > 0)
                <div class="count-indicator ms-auto bg-white shadow-sm px-3 py-2 rounded-pill small fw-bold text-success">
                    <i class="bi bi-bar-chart-fill me-2"></i>
                    <span>{{ $riwayat_setoran->count() }} Total Setoran</span>
                </div>
            @endif
        </div>

        <div class="history-card-wrapper p-2 p-md-4 shadow-sm border-0 bg-white" style="border-radius: 28px;">

            @if(isset($riwayat_setoran) && $riwayat_setoran->count() > 0)
                @foreach($riwayat_setoran as $item)
                    <div class="history-item-card d-flex align-items-center justify-content-between p-3 mb-3 border-start shadow-sm"
                        style="border-radius: 15px; border-left-color: #2e7d32 !important; background: #fff;"
                        data-bs-toggle="modal" data-bs-target="#detailModal" data-jenis="{{ $item->jenis->nama_jenis }}"
                        data-jenis="{{ $item->jenis->nama_jenis }}" data-berat="{{ $item->berat }}"
                        data-tanggal="{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}"
                        data-poin="{{ number_format($item->total_poin) }}"
                        
                        data-co2="{{ rtrim(rtrim(number_format($item->total_co2, 2), '0'), '.') }}"
                        data-air="{{ number_format($item->total_air, 0) }}"
                        data-listrik="{{ rtrim(rtrim(number_format($item->total_energi, 2), '0'), '.') }}">

                        <div class="d-flex align-items-center">
                            <div class="icon-box-history me-3 d-none d-md-flex"
                                style="width: 50px; height: 50px; background: #f0fdf4; color: #2e7d32; border-radius: 12px; font-size: 1.2rem;">
                                <i class="bi bi-box-seam"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1 text-dark">{{ $item->jenis->nama_jenis }}</h6>
                                <p class="text-muted small mb-0">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                    <span class="mx-2">•</span>
                                    {{ $item->berat }} kg
                                </p>
                            </div>
                        </div>
                        <div class="text-end">
                            <span class="points-earned fw-800 text-success">
                                +{{ number_format($item->total_poin) }} poin</span>
                        </div>
                    </div>
                @endforeach

            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="bi bi-clipboard-x text-light-emphasis" style="font-size: 4rem; opacity: 0.3;"></i>
                    </div>
                    <h5 class="fw-bold text-dark">Belum Ada Riwayat</h5>
                    <p class="text-muted small mb-4">Sepertinya kamu belum pernah menyetorkan sampah.<br>Yuk, mulai pilah
                        sampahmu hari ini!</p>
                    <a href="/dashboard_user" class="btn btn-success rounded-pill px-4 fw-bold shadow-sm">
                        <i class="bi bi-house-door-fill me-2"></i>Kembali ke Dashboard
                    </a>
                </div>
            @endif

        </div>
    </div>

    <div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="fw-800 mb-0">Detail Setoran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 pb-4">
                    <div class="text-center mb-4">
                        <div class="mx-auto mb-3"
                            style="width: 65px; height: 65px; background: #f0fdf4; color: #2e7d32; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.8rem;">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <h5 class="fw-bold mb-1" id="m-jenis">-</h5>
                        <p class="text-muted small mb-0" id="m-tanggal">-</p>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <div class="p-3 border rounded-4 text-center bg-light">
                                <p class="text-muted small mb-1">Berat</p>
                                <h6 class="fw-bold mb-0 text-dark"><span id="m-berat">0</span> kg</h6>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 border rounded-4 text-center bg-light">
                                <p class="text-muted small mb-1">Poin Didapat</p>
                                <h6 class="fw-bold mb-0 text-success">+<span id="m-poin">0</span> pts</h6>
                            </div>
                        </div>
                    </div>

                    <h6 class="fw-bold mb-3 d-flex align-items-center">
                        <i class="bi bi-leaf-fill text-success me-2"></i>Eco Impact
                    </h6>
                    <div class="impact-list p-3 bg-success bg-opacity-10 rounded-4">
                        <div class="d-flex align-items-center mb-3">
                            <div class="impact-icon me-3 text-secondary"><i class="bi bi-cloud-haze-fill"></i></div>
                            <div class="flex-grow-1">
                                <p class="text-muted small mb-0">CO2 Dihemat</p>
                                <h6 class="fw-bold mb-0 small"><span id="m-co2">0</span> kg CO2</h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="impact-icon me-3 text-primary"><i class="bi bi-droplet-fill"></i></div>
                            <div class="flex-grow-1">
                                <p class="text-muted small mb-0">Air Dihemat</p>
                                <h6 class="fw-bold mb-0 small"><span id="m-air">0</span> Liter</h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="impact-icon me-3 text-warning"><i class="bi bi-lightning-charge-fill"></i></div>
                            <div class="flex-grow-1">
                                <p class="text-muted small mb-0">Energi Listrik</p>
                                <h6 class="fw-bold mb-0 small"><span id="m-listrik">0</span> kWh</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const detailModal = document.getElementById('detailModal');
        if (detailModal) {
            detailModal.addEventListener('show.bs.modal', function (event) {
                const trigger = event.relatedTarget;

                document.getElementById('m-jenis').textContent = trigger.getAttribute('data-jenis');
                document.getElementById('m-tanggal').textContent = trigger.getAttribute('data-tanggal');
                document.getElementById('m-berat').textContent = trigger.getAttribute('data-berat');
                document.getElementById('m-poin').textContent = trigger.getAttribute('data-poin');
                document.getElementById('m-co2').textContent = trigger.getAttribute('data-co2');
                document.getElementById('m-air').textContent = trigger.getAttribute('data-air');
                document.getElementById('m-listrik').textContent = trigger.getAttribute('data-listrik');
            });
        }
    </script>
</body>

</html>