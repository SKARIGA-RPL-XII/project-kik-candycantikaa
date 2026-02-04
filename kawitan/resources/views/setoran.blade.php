<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Setoran Sampah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="dashboard-page">

@section('judulheader', 'Kelola Setoran Sampah')
@section('keteranganheader', 'Daftar Setoran Sampah')

@include('layout.sidebar_admin')
@include('layout.header_admin')

<div class="main-content">

    <div class="card shadow-sm mt-4">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center search-button-table">
                <div class="d-flex gap-2 w-80">
                    <input type="text" id="searchText" class="form-control w-50" placeholder="Cari nama / jenis sampah..." style="width: 160px;">

                    <input type="date" id="searchDate" class="form-control"  style="width: 160px;">

                    <select id="searchMonth" class="form-control" style="width: 160px;">
                        <option value="">Pilih Bulan</option>
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>

                <button id="btnRefresh" class="form-control btn-refresh">
                        <i class="bi bi-arrow-clockwise"></i>
                </button>

                </div>


                <button class="btn-green ms-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    + Tambah Setoran Sampah
                </button>
            </div>

            <div class="table-wrapper">
    <table class="table align-middle mb-0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Penyetor</th>
                <th>Jenis Sampah</th>
                <th>Berat (kg)</th>
                <th>Poin</th>
                <th>CO₂</th>
                <th>Air (L)</th>
                <th>Energi (kWh)</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody id = "tableBody">
            <tr>
                <td>1</td>
                <td>Nike</td>
                <td>Plastik</td>
                <td>1.5 kg</td>
                <td>5</td>
                <td>0.2 kg CO₂</td>
                <td>5 Liter</td>
                <td>0.5 kWh</td>
                <td>16-12-2025</td>
                <td>
                     <button type="button" class="btn-action edit" data-bs-toggle="modal" data-bs-target="#modalEdit">
                        <i class="bi bi-pencil"></i>
                    </button>

                    <button class="btn-action delete" data-bs-toggle="modal" data-bs-target="#modalHapus">
                        <i class="bi bi-trash"></i>
                     </button>    
                </td>
            </tr>
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
                <h5 class="modal-title">Tambah Setoran Sampah</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
            </div>

            <div class="modal-body px-4">
                <form>
                   <div class="mb-3">
                        <label class="form-label">Nama Penyetor <span class="text-danger">*</span></label>
                        <select class="form-control select2">
                            <option value="">Pilih Nama Penyetor</option>
                            <option>Andi Pratama</option>
                            <option>Siti Aisyah</option>
                            <option>Budi Santoso</option>
                            <option>Rina Lestari</option>
                            <option>Dewi Kartika</option>
                        </select>
                    </div>

                     <div class="mb-3">
                        <label class="form-label">Jenis Sampah <span class="text-danger">*</span></label>
                        <select class="form-control select2">
                            <option value="">Pilih Jenis Sampah</option>
                            <option>Plastik</option>
                            <option>Kardus</option>
                            <option>Kaca</option>
                            <option>Besi</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Berat <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" placeholder="Kg">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Poin <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" placeholder="Poin yang didapat">
                        </div>

                       <div class="col-md-4 mb-3">
                            <label class="form-label">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tanggalSetoran">
                        </div>

                    </div>

                       <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">CO₂ yang dihemat <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="co2Hemat" readonly>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Air yang dihemat <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="airHemat" readonly>
                        </div>

                         <div class="col-md-4 mb-3">
                            <label class="form-label">Energi yang dihemat <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="energiHemat" readonly>
                        </div>

                    </div>

                </form>
            </div>

            <div class="modal-footer border-0 px-4 pb-4">
                <button type="button" class="btn btn-outline-danger px-4" data-bs-dismiss="modal">
                    Batal
                </button>
                <button type="button" class="btn btn-success" id="btnSimpanJenis">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">Edit Setoran Sampah</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
            </div>

            <div class="modal-body px-4">
                <form>
                   <div class="mb-3">
                        <label class="form-label">Nama Penyetor <span class="text-danger">*</span></label>
                        <select class="form-control select2">
                            <option value="">Pilih Nama Penyetor</option>
                            <option>Andi Pratama</option>
                            <option>Siti Aisyah</option>
                            <option>Budi Santoso</option>
                            <option>Rina Lestari</option>
                            <option>Dewi Kartika</option>
                        </select>
                    </div>

                     <div class="mb-3">
                        <label class="form-label">Jenis Sampah <span class="text-danger">*</span></label>
                        <select class="form-control select2">
                            <option value="">Pilih Jenis Sampah</option>
                            <option>Plastik</option>
                            <option>Kardus</option>
                            <option>Kaca</option>
                            <option>Besi</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Berat <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" placeholder="Kg">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Poin <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" placeholder="Poin yang didapat">
                        </div>

                       <div class="col-md-4 mb-3">
                            <label class="form-label">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tanggalSetoran">
                        </div>

                    </div>

                       <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">CO₂ yang dihemat <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="co2Hemat" readonly>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Air yang dihemat <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="airHemat" readonly>
                        </div>

                         <div class="col-md-4 mb-3">
                            <label class="form-label">Energi yang dihemat <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="energiHemat" readonly>
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
            <h5>Data Setoran Sampah Berhasil Dihapus</h5>
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
            <p class="text-muted">Setoran sampah berhasil disimpan ke sistem.</p>
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
            <p class="text-muted">Setoran sampah berhasil diperbarui di sistem.</p>
            <button class="btn-green" data-bs-dismiss="modal">OK</button>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const searchText  = document.getElementById("searchText");
    const searchDate  = document.getElementById("searchDate");
    const searchMonth = document.getElementById("searchMonth");

    if (searchText) {
        searchText.addEventListener("input", filterTable);
    }
    if (searchDate) {
        searchDate.addEventListener("change", filterTable);
    }
    if (searchMonth) {
        searchMonth.addEventListener("change", filterTable);
    }
    if (btnRefresh) {
        btnRefresh.addEventListener("click", function () {
            searchText.value  = "";
            searchDate.value  = "";
            searchMonth.value = "";

            const rows = document.querySelectorAll("#tableBody tr");
            rows.forEach(row => {
                row.style.display = "";
            });
        });
    }

    function filterTable() {
        let text  = searchText.value.toLowerCase();
        let date  = searchDate.value;   
        let month = searchMonth.value;  

        let rows = document.querySelectorAll("table tbody tr");

        rows.forEach(row => {
            let rowText = row.innerText.toLowerCase();
            let tanggal = row.cells[8].innerText; 
            let show = true;

            if (text && !rowText.includes(text)) {
                show = false;
            }

            if (date && tanggal !== date) {
                show = false;
            }

            if (month) {
                let rowMonth = tanggal.split("-")[1]; 
                if (rowMonth !== month) {
                    show = false;
                }
            }

            row.style.display = show ? "" : "none";
        });
    }

});
</script>




</body>
</html>
