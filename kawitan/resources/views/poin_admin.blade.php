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
    @section('keteranganheader', 'Daftar Keseluruhan Laporan Poin')

    @include('layout.sidebar_admin')
    @include('layout.header_admin')

    <div class="main-content">
        <div class="card shadow-sm">
            <div class="card-body">

                <form method="GET" id="filterForm">
                    <div class="d-flex justify-content-between align-items-center search-button-table">
                        <div class="d-flex gap-2">

                            <input type="text" name="searchText" class="form-control" placeholder="Cari Data..."
                                style="width:260px" value="{{ request('searchText') }}" oninput="autoSubmit()">

                            <input type="date" name="searchDate" class="form-control" style="width:170px"
                                value="{{ request('searchDate') }}" onchange="autoSubmit()">

                            <select name="searchMonth" class="form-control" style="width:160px" onchange="autoSubmit()">
                                <option value="">Pilih Bulan</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ request('searchMonth') == $i ? 'selected' : '' }}>
                                        {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                    </option>
                                @endfor
                            </select>

                            <select name="searchKeterangan" class="form-control" style="width:200px"
                                onchange="autoSubmit()">
                                <option value="">Semua Keterangan</option>
                                <option value="setor sampah" {{ request('searchKeterangan') == 'setor sampah' ? 'selected' : '' }}>
                                    Setor Sampah
                                </option>
                                <option value="penukaran hadiah" {{ request('searchKeterangan') == 'penukaran hadiah' ? 'selected' : '' }}>
                                    Penukaran Hadiah
                                </option>
                            </select>

                            <a href="{{ url('/poin_admin') }}" class="form-control btn-refresh text-center">
                                <i class="bi bi-arrow-clockwise"></i>
                            </a>

                        </div>
                    </div>
                </form>

                <div class="table-wrapper mt-3">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Pengguna</th>
                                <th>Keterangan</th>
                                <th>Poin</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($laporan as $row)
                                                        <tr>
                                                            <td>{{ $laporan->firstItem() + $loop->index }}</td>

                                                            <td>
                                                                {{ $row->tanggal
                                                                ? \Carbon\Carbon::parse($row->tanggal)->format('d M Y') : '-' 
                                                                }}
                                                            </td>

                                                            <td>{{ $row->nama_user }}</td>

                                                            <td>{{ $row->keterangan }}</td>

                                                            <td>
                                                                @if($row->poin > 0)
                                                                    <span class="text-success fw-semibold">
                                                                        +{{ $row->poin }}
                                                                    </span>
                                                                @else
                                                                    <span class="text-danger fw-semibold">
                                                                        {{ $row->poin }}
                                                                    </span>
                                                                @endif
                                                            </td>
                                                        </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="table-footer">
                        <div class="table-footer-left">
                            Showing {{ $laporan->firstItem() }}
                            to {{ $laporan->lastItem() }}
                            of {{ $laporan->total() }} results
                        </div>

                        <div class="table-footer-right">
                            {{ $laporan->links('pagination::bootstrap-5') }}
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <script>
        function autoSubmit() {
            document.getElementById('filterForm').submit();
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>