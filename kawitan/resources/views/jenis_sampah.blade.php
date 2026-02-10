<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Jenis Sampah</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="dashboard-page">

    @section('judulheader', 'Jenis Sampah')
    @section('keteranganheader', 'Daftar Jenis Sampah')

    @include('layout.sidebar_admin')
    @include('layout.header_admin')

    <div class="main-content">

        <div class="card shadow-sm">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center search-button-table">
                    <div class="d-flex gap-2">
                        <input type="text" id="searchText" class="form-control" placeholder="Cari Data..."
                            style="width:320px;">
                        <button id="btnRefresh" class="form-control btn-refresh">
                            <i class="bi bi-arrow-clockwise"></i>
                        </button>
                    </div>

                    <button class="btn-green" data-bs-toggle="modal" data-bs-target="#modalTambah">
                        + Tambah Jenis Sampah
                    </button>
                </div>

                <div class="table-wrapper">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis Sampah</th>
                                <th>Poin / Kg</th>
                                <th>CO₂ / Kg</th>
                                <th>Air / Kg</th>
                                <th>Energi / Kg</th>
                                <th class="col-aksi">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">

                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $data->firstItem() + $loop->index }}</td>
                                    <td>{{ $item->nama_jenis }}</td>
                                    <td>{{ $item->poin_per_kg }} Poin</td>
                                    <td>{{ (float) $item->co2_per_kg }} kg CO₂</td>
                                    <td>{{ (float) $item->air_per_kg }} L</td>
                                    <td>{{ (float) $item->energi_per_kg }} kWh</td>
                                    <td class="col-aksi">
                                        <button type="button" class="btn-action edit" data-bs-toggle="modal"
                                            data-bs-target="#modalEdit{{ $item->id_jenis }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>


                                        <button class="btn-action delete" data-id="{{ $item->id_jenis }}"
                                            onclick="showHapusModal(this)">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                        <form id="formHapus{{ $item->id_jenis }}"
                                            action="{{ route('jenis-sampah.destroy', $item->id_jenis) }}" method="POST"
                                            class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
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

    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <form action="{{ route('jenis-sampah.store') }}" method="POST">
                    @csrf

                    <div class="modal-header border-0">
                        <h5 class="modal-title">Tambah Jenis Sampah</h5>
                    </div>

                    <div class="modal-body px-4">

                        <div class="mb-3">
                            <label class="form-label">Jenis Sampah</label>
                            <input type="text" name="nama_jenis" class="form-control"
                                placeholder="Masukkan Jenis Sampah" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Poin / Kg</label>
                            <input type="number" name="poin_per_kg" class="form-control" placeholder="Masukkan Poin/kg"
                                required>
                        </div>


                        <!-- <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">CO₂ / Kg</label>
                                <input type="number" step="0.01" class="form-control" value="Otomatis" readonly>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Air / Kg</label>
                                <input type="number" step="0.01" class="form-control" value="Otomatis" readonly>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Energi / Kg</label>
                                <input type="number" step="0.01" class="form-control" value="Otomatis" readonly>
                            </div>
                        </div> -->

                        <p class="text-muted small">
                            * Nilai eco impact dihitung otomatis berdasarkan jenis sampah
                        </p>

                    </div>

                    <div class="modal-footer border-0 px-4 pb-4">
                        <button type="button" class="btn btn-outline-danger px-4" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn-green px-4">
                            Simpan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>


    @foreach ($data as $item)
        <div class="modal fade" id="modalEdit{{ $item->id_jenis }}" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">

                    <form action="{{ route('jenis-sampah.update', $item->id_jenis) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="modal-header border-0">
                            <h5 class="modal-title">Edit Jenis Sampah</h5>
                        </div>

                        <div class="modal-body px-4">

                            <div class="mb-3">
                                <label class="form-label">Jenis Sampah</label>
                                <input type="text" name="nama_jenis" class="form-control" value="{{ $item->nama_jenis }}"
                                    required>
                            </div>

                            <!-- <div class="row"> -->
                            <div class="mb-3">
                                <label class="form-label">Poin / Kg</label>
                                <input type="number" name="poin_per_kg" class="form-control"
                                    value="{{ $item->poin_per_kg }}" required>
                            </div>

                            <!-- <div class="col-md-6 mb-3">
                                                                    <label class="form-label">CO₂ / Kg</label>
                                                                    <input type="number" step="0.01" name="co2_per_kg" class="form-control"
                                                                        value="{{ $item->co2_per_kg }}" required>
                                                                </div> -->
                            <!-- </div> -->

                            <!-- <div class="row">
                                                                <div class="col-md-6 mb-3">
                                                                    <label class="form-label">Air / Kg</label>
                                                                    <input type="number" step="0.01" name="air_per_kg" class="form-control"
                                                                        value="{{ $item->air_per_kg }}" required>
                                                                </div>

                                                                <div class="col-md-6 mb-3">
                                                                    <label class="form-label">Energi / Kg</label>
                                                                    <input type="number" step="0.01" name="energi_per_kg" class="form-control"
                                                                        value="{{ $item->energi_per_kg }}" required>
                                                                </div>
                                                            </div> -->

                            <p class="text-muted small">
                                * Nilai eco impact dihitung otomatis berdasarkan jenis sampah
                            </p>

                        </div>

                        <div class="modal-footer border-0 px-4 pb-4">
                            <button type="button" class="btn btn-outline-danger px-4" data-bs-dismiss="modal">
                                Batal
                            </button>
                            <button type="submit" class="btn-green px-4">
                                Simpan
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    @endforeach


    <div class="modal fade" id="modalKonfirmasiHapus" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <div class="icon-circle-danger">
                    <i class="bi bi-exclamation-circle text-danger fs-2"></i>
                </div>
                <h5>Apakah Anda yakin?</h5>
                <p class="text-muted">Data yang dihapus tidak dapat dikembalikan!</p>

                <div class="d-flex justify-content-center gap-3">
                    <button class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                    <button class="btn-green" id="btnYaHapus">Ya, Saya Yakin</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalBerhasilTambah" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <div class="icon-circle-success">
                    <i class="bi bi-check-circle text-success fs-2"></i>
                </div>
                <h5>Data Berhasil Ditambahkan</h5>
                <p class="text-muted">Jenis sampah berhasil disimpan ke sistem.</p>
                <button class="btn-green w-100" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalBerhasilEdit" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <div class="icon-circle-success">
                    <i class="bi bi-check-circle text-success fs-2"></i>
                </div>
                <h5>Data Berhasil Diperbarui</h5>
                <p class="text-muted">Jenis sampah berhasil diperbarui.</p>
                <button class="btn-green w-100" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalBerhasilHapus" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <div class="icon-circle-danger">
                    <i class="bi bi-trash text-danger fs-2"></i>
                </div>
                <h5>Data Jenis Sampah Berhasil Dihapus</h5>
                <p class="text-muted">Data telah dihapus dari sistem.</p>
                <button class="btn-green w-100" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            let idHapus = null;

            const btnYaHapus = document.getElementById('btnYaHapus');
            const searchText = document.getElementById('searchText');
            const btnRefresh = document.getElementById('btnRefresh');

            window.showHapusModal = function (btn) {
                idHapus = btn.dataset.id;
                new bootstrap.Modal(document.getElementById('modalKonfirmasiHapus')).show();
            };

            if (btnYaHapus) {
                btnYaHapus.addEventListener('click', function () {
                    if (idHapus) {
                        document.getElementById('formHapus' + idHapus).submit();
                    }
                });
            }

            if (searchText) {
                searchText.addEventListener('input', function () {
                    let v = this.value.toLowerCase();
                    document.querySelectorAll('#tableBody tr').forEach(r => {
                        r.style.display = r.textContent.toLowerCase().includes(v) ? '' : 'none';
                    });
                });
            }

            if (btnRefresh) {
                btnRefresh.addEventListener('click', function () {
                    searchText.value = '';
                    document.querySelectorAll('#tableBody tr').forEach(r => r.style.display = '');
                });
            }

        });
    </script>


    @if (session('tambah_success'))
        <script>new bootstrap.Modal(document.getElementById('modalBerhasilTambah')).show();</script>
    @endif
    @if (session('edit_success'))
        <script>new bootstrap.Modal(document.getElementById('modalBerhasilEdit')).show();</script>
    @endif
    @if (session('hapus_success'))
        <script>new bootstrap.Modal(document.getElementById('modalBerhasilHapus')).show();</script>
    @endif

</body>

</html>