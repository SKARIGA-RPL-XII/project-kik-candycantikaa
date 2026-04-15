<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Eco Impact</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="dashboard-page">

    @section('judulheader', 'Laporan Eco Impact')
    @section('keteranganheader', 'Daftar Keseluruhan Eco Impact Oleh Nasabah')

    @include('layout.sidebar_admin')
    @include('layout.header_admin')

    <div class="main-content">

        <div class="card shadow-sm mt-2">
            <div class="card-body">

                <form method="GET" action="{{ route('eco_admin') }}" class="d-flex align-items-center gap-2 mb-3">

                    <input type="text" name="search" class="form-control"
                        placeholder="Cari Data..."
                        style="width: 400px;"
                        value="{{ request('search') }}"
                        oninput="this.form.submit()">

                    <a href="{{ route('eco_admin') }}" class="form-control btn-refresh">
                        <i class="bi bi-arrow-clockwise"></i>
                    </a>

                </form>

                <div class="table-wrapper">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis Sampah</th>
                                <th>Total Berat</th>
                                <th>CO₂ Hemat</th>
                                <th>Air Hemat</th>
                                <th>Energi Hemat</th>
                            </tr>
                        </thead>

                        <tbody id="tableBody">
                            @forelse ($data as $i => $row)
                                <tr>
                                    <td>{{ $data->firstItem() + $i }}</td>
                                    <td>{{ $row->nama_jenis }}</td>
                                    <td>{{ $row->total_berat }} kg</td>
                                    <td>{{ $row->co2 }} kg</td>
                                    <td>{{ $row->air }} L</td>
                                    <td>{{ $row->energi }} kWh</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Data tidak tersedia</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="table-footer">
                        <div class="table-footer-left">
                            Showing
                            {{ $data->firstItem() }}
                            to
                            {{ $data->lastItem() }}
                            of
                            {{ $data->total() }} results
                        </div>

                        <div class="table-footer-right">
                            {{ $data->links('pagination::bootstrap-5') }}
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>