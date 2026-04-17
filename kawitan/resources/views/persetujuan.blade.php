<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Persetujuan Penukaran Poin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="dashboard-page">

    @section('judulheader', 'Persetujuan Penukaran Poin')
    @section('keteranganheader', 'Daftar Persetujuan Penukaran Poin')

    @include('layout.sidebar_admin')
    @include('layout.header_admin')

    <div class="main-content">
        <div class="card shadow-sm ">
            <div class="card-body">

                <div class="d-flex gap-2 mb-4">
                    <form method="GET" action="{{ route('admin.persetujuan') }}" class="d-flex gap-2">

                        <input type="text" name="search" class="form-control" placeholder="Cari Data..."
                            value="{{ request('search') }}" style="width:260px">

                        <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}"
                            style="width:170px">

                        <select name="bulan" class="form-control" style="width:160px">
                            <option value="">Pilih Bulan</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ sprintf('%02d', $i) }}" {{ request('bulan') == sprintf('%02d', $i) ? 'selected' : '' }}>
                                    {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                </option>
                            @endfor
                        </select>

                        <select name="status" class="form-control" style="width:170px">
                            <option value="">Semua Status</option>
                            <option value="menunggu" {{ request('status') == 'menunggu' ? 'selected' : '' }}>Menunggu
                            </option>
                            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai
                            </option>
                            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak
                            </option>
                        </select>

                        <button id="btnRefresh" type="button" class="form-control btn-refresh">
                            <i class="bi bi-arrow-clockwise"></i>
                        </button>

                    </form>
                </div>

                <div class="table-wrapper">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pengguna</th>
                                <th>Hadiah</th>
                                <th>Poin</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $data->firstItem() + $loop->index }}</td>
                                    <td>{{ $row->riwayatPoin->user->username ?? '-' }}</td>
                                    <td>{{ $row->hadiah->nama_hadiah }}</td>
                                    <td>{{ $row->poin_dipakai }}</td>
                                    <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d M Y H:i') }}</td>

                                    <td>
                                        @if ($row->status === 'menunggu')
                                            <span class="badge-status badge-pending">
                                                <i class="bi bi-hourglass-split"></i> Menunggu
                                            </span>
                                        @elseif ($row->status === 'selesai')
                                            <span class="badge-status badge-approved">
                                                <i class="bi bi-check-circle-fill"></i> Selesai
                                            </span>
                                        @elseif ($row->status === 'ditolak')
                                            <span class="badge-status badge-rejected">
                                                <i class="bi bi-x-circle-fill"></i> Ditolak
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($row->status === 'ditolak' && $row->keterangan)
                                            <span class="text-danger">
                                                <i class="bi bi-x-circle"></i> {{ $row->keterangan }}
                                            </span>

                                        @elseif ($row->status === 'selesai')
                                            <span class="text-success">
                                                <i class="bi bi-check-circle"></i> Berhasil menukar poin
                                            </span>

                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($row->status === 'menunggu')
                                            <button class="btn-action edit btn-setujui" data-id="{{ $row->id_penukaran }}"
                                                data-bs-toggle="modal" data-bs-target="#modalSetujui">
                                                <i class="bi bi-check-lg"></i>
                                            </button>

                                            <button class="btn-action delete btn-tolak" data-id="{{ $row->id_penukaran }}"
                                                data-bs-toggle="modal" data-bs-target="#modalTolak">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                    <div class="table-footer">
                        <div class="table-footer-left">
                            Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} results
                        </div>

                        <div class="table-footer-right">
                            {{ $data->links('pagination::bootstrap-5') }}
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <form id="formSetujui" method="POST">
        @csrf
    </form>

    <form id="formTolak" method="POST">
        @csrf
        <input type="hidden" name="keterangan" id="hiddenKeterangan">
    </form>

    <div class="modal fade" id="modalSetujui" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">

                <div class="icon-circle-success">
                    <i class="bi bi-check-circle text-success fs-2"></i>
                </div>

                <h5>Setujui Penukaran Poin?</h5>
                <p class="text-muted">
                    Hadiah akan diproses dan poin pengguna akan dikurangi.
                </p>

                <div class="d-flex justify-content-center gap-3">
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button class="btn-green" id="btnYaSetujui">
                        Ya, Setujui
                    </button>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTolak" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">

                <div class="icon-circle-danger">
                    <i class="bi bi-x-circle text-danger fs-2"></i>
                </div>

                <h5>Tolak Penukaran Poin?</h5>
                <p class="text-muted">
                    Permintaan akan ditolak dan tidak akan diproses.
                </p>

                <textarea id="inputKeterangan" class="form-control mt-3"
                    placeholder="Masukkan alasan penolakan..."></textarea>

                <div class="d-flex justify-content-center gap-3 mt-3">
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button class="btn btn-danger" id="btnYaTolak">
                        Ya, Tolak
                    </button>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            let idDipilih = null;

            document.querySelectorAll('.btn-setujui').forEach(btn => {
                btn.addEventListener('click', function () {
                    idDipilih = this.dataset.id;
                    document.getElementById('formSetujui').action =
                        `/penukaran-poin/setujui/${idDipilih}`;
                });
            });

            document.querySelectorAll('.btn-tolak').forEach(btn => {
                btn.addEventListener('click', function () {
                    idDipilih = this.dataset.id;
                    document.getElementById('formTolak').action =
                        `/penukaran-poin/tolak/${idDipilih}`;
                });
            });

            document.getElementById('btnYaSetujui').addEventListener('click', function () {
                document.getElementById('formSetujui').submit();
            });

            document.getElementById('btnYaTolak').addEventListener('click', function (e) {
                e.preventDefault(); 
                let alasan = document.getElementById('inputKeterangan').value.trim();

                if (alasan === '') {
                    alert('Alasan penolakan wajib diisi!');
                    return;
                }

                document.getElementById('hiddenKeterangan').value = alasan;

                setTimeout(() => {
                    document.getElementById('formTolak').submit();
                }, 100);
            });

            const form = document.querySelector('form[action="{{ route('admin.persetujuan') }}"]');
            const searchInput = document.querySelector('input[name="search"]');
            const tanggalInput = document.querySelector('input[name="tanggal"]');
            const bulanSelect = document.querySelector('select[name="bulan"]');
            const statusSelect = document.querySelector('select[name="status"]');

            let delay;
            searchInput.addEventListener('input', function () {
                clearTimeout(delay);
                delay = setTimeout(() => form.submit(), 500);
            });

            tanggalInput.addEventListener('change', () => form.submit());
            bulanSelect.addEventListener('change', () => form.submit());
            statusSelect.addEventListener('change', () => form.submit());

            document.getElementById('btnRefresh').addEventListener('click', function () {
                window.location.href = "{{ route('admin.persetujuan') }}";
            });

        });
    </script>


</body>

</html>