<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Poin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="dashboard-page">

@section('judulheader', 'Laporan Poin')
@section('keteranganheader', 'Laporan Poin Keseluruhan')

@include('layout.sidebar_admin')
@include('layout.header_admin')

<div class="main-content">

    <div class="card shadow-sm mt-4">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center search-button-table">
                 <div class="d-flex gap-2 w-80">
                    <input type="text" id="searchText" class="form-control w-50" placeholder="Cari Data..." style="width: 160px;">

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
</div>

            <div class="table-wrapper">
    <table class="table align-middle mb-0">
        <thead>
            <tr>
                <th>No</th>
                 <th>Tanggal</th>
                <th>Nama Pengguna</th>
                <th>Jenis Sampah</th>
                <th>Berat</th>
                <th>Poin Masuk</th>
                <th>Poin Keluar</th>
            </tr>
        </thead>
        <tbody id = "tableBody">
            <tr>
                <td>1</td>
                <td>2025-11-12</td>
                <td>Budi Santoso</td>
                <td>Kardus</td>
                <td>15 kg</td>
                <td>20</td>
                <td>10</td>
            </tr>
        </tbody>
    </table>
</div>

        </div>
    </div>

</div>

<div class="modal fade" id="modalSetujui" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-4">
            <div class="mb-3">
                <div class="icon-circle-success">
                    <i class="bi bi-check-circle text-success fs-2"></i>
                </div>
            </div>
            <h5>Setujui Penukaran Poin?</h5>
            <p class="text-muted">Poin akan dikurangi dan hadiah akan diproses.</p>
            <div class="d-flex justify-content-center gap-3">
                <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-success" id="btnSetujui">Setujui</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTolak" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-4">
            <div class="mb-3">
                <div class="icon-circle-danger">
                    <i class="bi bi-x-circle text-danger fs-2"></i>
                </div>
            </div>
            <h5>Tolak Penukaran Poin?</h5>
            <p class="text-muted">Permintaan akan ditolak dan poin tidak dipotong.</p>
            <div class="d-flex justify-content-center gap-3">
                <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-danger" id="btnTolak">Tolak</button>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const btnSetujui = document.getElementById("btnSetujui");
    if (btnSetujui) {
        btnSetujui.addEventListener("click", function () {
            let modal = bootstrap.Modal.getInstance(document.getElementById("modalSetujui"));
            modal.hide();
        });
    }

    const btnTolak = document.getElementById("btnTolak");
    if (btnTolak) {
        btnTolak.addEventListener("click", function () {
            let modal = bootstrap.Modal.getInstance(document.getElementById("modalTolak"));
            modal.hide();
        });
    }

    const searchText  = document.getElementById("searchText");
    const searchDate  = document.getElementById("searchDate");
    const searchMonth = document.getElementById("searchMonth");

    if (searchText)  searchText.addEventListener("input", filterTable);
    if (searchDate)  searchDate.addEventListener("change", filterTable);
    if (searchMonth) searchMonth.addEventListener("change", filterTable);

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

        let rows = document.querySelectorAll("#tableBody tr");

        rows.forEach(row => {
            let nama    = row.cells[1].innerText.toLowerCase(); 
            let hadiah  = row.cells[2].innerText.toLowerCase(); 
            let tanggal = row.cells[4].innerText;               

            let show = true;

            if (text && !(nama.includes(text) || hadiah.includes(text))) {
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
