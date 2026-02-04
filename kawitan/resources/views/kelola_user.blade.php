<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kelola Data Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="dashboard-page">

    @section('judulheader', 'Kelola Data Pengguna')
    @section('keteranganheader', 'Daftar Pengguna')

    @include('layout.sidebar_admin')
    @include('layout.header_admin')

    <div class="main-content">

        <div class="card shadow-sm mt-4">
            <div class="card-body">

                <div class="d-flex align-items-center gap-2 mb-3">
                    <input type="text" id="searchText" class="form-control" placeholder="Cari Data..."
                        style="width: 400px;">

                    <button id="btnRefresh" class="form-control btn-refresh" title="Reset Filter">
                        <i class="bi bi-arrow-clockwise"></i>
                    </button>
                </div>


                <div class="table-wrapper">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pengguna</th>
                                <th>Email</th>
                                <th>No. Telepon</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            <tr>
                                <td>1</td>
                                <td>Cantika Berliana</td>
                                <td>caca@gmail.com</td>
                                <td>08123456789</td>
                            </tr>


                            <script
                                src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    const searchText = document.getElementById("searchText");
                                    const btnRefresh = document.getElementById("btnRefresh");

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

                                    function filterTable() {
                                        const input = searchText.value.toLowerCase();
                                        const rows = document.querySelectorAll("#tableBody tr");

                                        rows.forEach(row => {
                                            const text = row.textContent.toLowerCase();
                                            if (text.includes(input)) {
                                                row.style.display = "";
                                            } else {
                                                row.style.display = "none";
                                            }
                                        });
                                    }
                                });
                            </script>


</body>

</html>