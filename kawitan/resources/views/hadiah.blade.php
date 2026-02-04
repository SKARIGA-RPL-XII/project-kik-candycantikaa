<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kelola Hadiah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="dashboard-page">

    @section('judulheader', 'Kelola Hadiah')
    @section('keteranganheader', 'Daftar Hadiah')

    @include('layout.sidebar_admin')
    @include('layout.header_admin')

    <div class="main-content">

        <div class="card shadow-sm mt-4">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center search-button-table">

                    <div class="d-flex align-items-center gap-2">
                        <input type="text" id="searchText" class="form-control" placeholder="Cari Data..."
                            style="width: 400px;">

                        <button id="btnRefresh" class="form-control btn-refresh" title="Reset Filter">
                            <i class="bi bi-arrow-clockwise"></i>
                        </button>
                    </div>

                    <button class="btn-green" data-bs-toggle="modal" data-bs-target="#modalTambah">
                        + Tambah Hadiah
                    </button>

                </div>



                <div class="table-wrapper">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama</th>
                                <th>Poin</th>
                                <th>Stok</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <tr>
                                <td>1</td>
                                <td><img src="{{ asset('images/Tempat Sampah.jpg') }}" width="48"></td>
                                <td>Tempat Sampah Premium</td>
                                <td>50</td>
                                <td>20</td>
                                <td>Tempat sampah berkualitas tinggi dengan desain modern, kuat, dan tahan lama. Cocok
                                    untuk penggunaan rumah maupun kantor.</td>
                                <td>
                                    <button type="button" class="btn-action edit" data-bs-toggle="modal"
                                        data-bs-target="#modalEdit">
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    <button class="btn-action delete" data-bs-toggle="modal"
                                        data-bs-target="#modalHapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <!-- <tr>
                <td>2</td>
                <td>Plastik Botol</td>
                <td>10 Poin</td>
                <td>1.5 kg CO₂</td>
                <td>30 Liter</td>
                <td>2.0 kWh</td>
                <td>
                    <a href="#" class="btn-action edit">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <a href="#" class="btn-action delete">
                        <i class="bi bi-trash"></i>
                    </a>
                </td>
            </tr> -->
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

    <div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">Tambah Hadiah</h5>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
                </div>

                <div class="modal-body px-4">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Gambar <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" accept="image/*">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Masukkan nama hadiah">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">Poin<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" placeholder="Masukkan poin">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">Stok<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" placeholder="Masukkan stok">
                            </div>

                        </div>

                        <div class="row">
                            <div class="mb-3">
                                <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                <textarea class="form-control" rows="4"
                                    placeholder="Masukkan deskripsi hadiah"></textarea>
                            </div>

                        </div>
                    </form>
                </div>

                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="button" class="btn btn-outline-danger px-4" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button class="btn btn-success" id="btnSimpanJenis">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">Edit Hadiah</h5>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
                </div>

                <div class="modal-body px-4">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Gambar <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" accept="image/*">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Masukkan nama hadiah">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">Poin<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" placeholder="Masukkan poin">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">Stok<span class="text-danger">*</span></label>
                                <input type="number" class="form-control" placeholder="Masukkan stok">
                            </div>

                        </div>

                        <div class="row">
                            <div class="mb-3">
                                <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                                <textarea class="form-control" rows="4"
                                    placeholder="Masukkan deskripsi hadiah"></textarea>
                            </div>

                        </div>
                    </form>
                </div>

                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="button" class="btn btn-outline-danger px-4" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="button" class="btn btn-success px-4" id="btnSimpanEdit">
                        Simpan
                    </button>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalHapus" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <div class="mb-3">
                    <div class="icon-circle-danger">
                        <i class="bi bi-exclamation-circle text-danger fs-2"></i>
                    </div>

                    <!-- <div class="rounded-circle bg-danger bg-opacity-25 d-inline-flex p-3">
                    <i class="bi bi-exclamation-circle text-danger fs-2"></i>
                </div> -->
                </div>
                <h5>Apakah Anda yakin?</h5>
                <p class="text-muted">Data yang dihapus tidak dapat dikembalikan!</p>
                <div class="d-flex justify-content-center gap-3">
                    <button class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-success" id="btnKonfirmasiHapus">Ya, Saya Yakin</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalBerhasilHapus" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <div class="mb-3">
                    <div class="icon-circle-danger">
                        <i class="bi bi-trash text-danger fs-2"></i>
                    </div>
                </div>
                <h5>Data Hadiah Berhasil Dihapus</h5>
                <p class="text-muted">Data telah dihapus dari sistem.</p>
                <button class="btn-green" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalBerhasilTambah" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <div class="mb-3">
                    <div class="icon-circle-success">
                        <i class="bi bi-check-circle text-success fs-2"></i>
                    </div>
                </div>
                <h5>Data Berhasil Ditambahkan</h5>
                <p class="text-muted">Hadiah berhasil disimpan ke sistem.</p>
                <button class="btn-green" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalBerhasilEdit" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <div class="mb-3">
                    <div class="icon-circle-success">
                        <i class="bi bi-pencil-square text-success fs-2"></i>
                    </div>
                </div>
                <h5>Data Berhasil Diperbarui</h5>
                <p class="text-muted">Hadiah berhasil diperbarui di sistem.</p>
                <button class="btn-green" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const searchText = document.getElementById("searchText");
            if (searchText) {
                searchText.addEventListener("input", filterTable);
            }

            if (btnRefresh) {
                btnRefresh.addEventListener("click", function () {
                    searchText.value = "";

                    const rows = document.querySelectorAll("#tableBody tr");
                    rows.forEach(row => {
                        row.style.display = "";
                    });
                });
            }

            document.getElementById("btnKonfirmasiHapus").addEventListener("click", function () {
                let modalHapus = bootstrap.Modal.getInstance(document.getElementById("modalHapus"));
                modalHapus.hide();

                let modalBerhasilHapus = new bootstrap.Modal(document.getElementById("modalBerhasilHapus"));
                modalBerhasilHapus.show();
            });

            document.getElementById("btnSimpanJenis").addEventListener("click", function () {
                let modalTambah = bootstrap.Modal.getInstance(document.getElementById("modalTambah"));
                modalTambah.hide();

                let modalBerhasilTambah = new bootstrap.Modal(document.getElementById("modalBerhasilTambah"));
                modalBerhasilTambah.show();
            });

            document.getElementById("btnSimpanEdit").addEventListener("click", function () {
                let modalEdit = bootstrap.Modal.getInstance(document.getElementById("modalEdit"));
                modalEdit.hide();

                let modalBerhasilEdit = new bootstrap.Modal(document.getElementById("modalBerhasilEdit"));
                modalBerhasilEdit.show();
            });

        });

        function filterTable() {
            const input = document.getElementById("searchText").value.toLowerCase();
            const rows = document.querySelectorAll("#tableBody tr");

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(input) ? "" : "none";
            });
        }
    </script>



</body>

</html>