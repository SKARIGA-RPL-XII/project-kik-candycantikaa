<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kelola Setoran Sampah</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="dashboard-page">

    @section('judulheader', 'Kelola Setoran Sampah')
    @section('keteranganheader', 'Daftar Setoran Sampah')

    @include('layout.sidebar_admin')
    @include('layout.header_admin')

    <div class="main-content">
        <div class="card shadow-sm">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center search-button-table">

                    <div class="d-flex gap-2">
                        <form method="GET" action="{{ route('setoran.index') }}" class="d-flex gap-2">

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

                            <button id="btnRefresh" type="button" class="form-control btn-refresh">
                                <i class="bi bi-arrow-clockwise"></i>
                            </button>

                        </form>
                    </div>

                    <button class="btn-green" data-bs-toggle="modal" data-bs-target="#modalTambah">
                        + Tambah Setoran
                    </button>

                </div>

                <div class="table-wrapper">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Berat</th>
                                <th>Poin</th>
                                <th>CO₂</th>
                                <th>Air</th>
                                <th>Energi</th>
                                <th>Tanggal</th>
                                <th class="col-aksi">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($setoran as $item)
                                <tr>
                                    <td>{{ $setoran->firstItem() + $loop->index }}</td>
                                    <td>{{ $item->user->username }}</td>
                                    <td>{{ $item->jenis->nama_jenis }}</td>
                                    <td>{{ $item->berat }} kg</td>
                                    <td>{{ $item->total_poin }}</td>
                                    <td>{{ $item->total_co2 }}</td>
                                    <td>{{ $item->total_air }}</td>
                                    <td>{{ $item->total_energi }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>

                                    <td class="col-aksi">
                                        <button class="btn-action edit" data-bs-toggle="modal"
                                            data-bs-target="#modalEdit{{ $item->id_setoran }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>

                                        <button class="btn-action delete" data-id="{{ $item->id_setoran }}"
                                            onclick="showHapusModal(this)">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                        <form id="formHapus{{ $item->id_setoran }}"
                                            action="{{ route('setoran.destroy', $item->id_setoran) }}" method="POST"
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
                            Showing {{ $setoran->firstItem() }}
                            to {{ $setoran->lastItem() }}
                            of {{ $setoran->total() }} results
                        </div>
                        <div class="table-footer-right">
                            {{ $setoran->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <form action="{{ route('setoran.store') }}" method="POST">
                    @csrf

                    <div class="modal-header border-0">
                        <h5 class="modal-title">Tambah Setoran Sampah</h5>
                    </div>

                    <div class="modal-body px-4">

                        <div class="mb-3">
                            <label>Nama Penyetor</label>
                            <select name="id_user" class="form-control select2" required>
                                <option></option>
                                @foreach ($users as $u)
                                    <option value="{{ $u->id_user }}">{{ $u->username }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Jenis Sampah</label>
                            <select name="id_jenis" id="jenisSelect" class="form-control select2" required>
                                <option></option>
                                @foreach ($jenisSampah as $j)
                                    <option value="{{ $j->id_jenis }}" data-poin="{{ $j->poin_per_kg }}"
                                        data-co2="{{ $j->co2_per_kg }}" data-air="{{ $j->air_per_kg }}"
                                        data-energi="{{ $j->energi_per_kg }}">
                                        {{ $j->nama_jenis }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label>Berat (kg)</label>
                                <input type="number" step="0.01" name="berat" id="beratInput" class="form-control"
                                    required>
                            </div>

                            <div class="col-md-4">
                                <label>Poin</label>
                                <input type="number" name="total_poin" id="poinAuto" class="form-control" readonly>
                            </div>

                            <div class="col-md-4">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}"
                                    readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label>CO₂</label>
                                <input type="number" name="total_co2" id="co2Auto" class="form-control" readonly>
                            </div>

                            <div class="col-md-4">
                                <label>Air</label>
                                <input type="number" name="total_air" id="airAuto" class="form-control" readonly>
                            </div>

                            <div class="col-md-4">
                                <label>Energi</label>
                                <input type="number" name="total_energi" id="energiAuto" class="form-control" readonly>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn-green">
                            Simpan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    @foreach ($setoran as $item)
        <div class="modal fade" id="modalEdit{{ $item->id_setoran }}" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">

                    <form action="{{ route('setoran.update', $item->id_setoran) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="modal-header border-0">
                            <h5 class="modal-title">Edit Setoran Sampah</h5>
                        </div>

                        <div class="modal-body px-4">

                            <div class="mb-3">
                                <label>Jenis Sampah</label>
                                <select class="form-control jenis-edit" data-id="{{ $item->id_setoran }}" disabled>
                                    @foreach ($jenisSampah as $j)
                                        <option value="{{ $j->id_jenis }}" data-poin="{{ $j->poin_per_kg }}"
                                            data-co2="{{ $j->co2_per_kg }}" data-air="{{ $j->air_per_kg }}"
                                            data-energi="{{ $j->energi_per_kg }}" {{ $item->id_jenis == $j->id_jenis ? 'selected' : '' }}>
                                            {{ $j->nama_jenis }}
                                        </option>
                                    @endforeach
                                </select>

                                <input type="hidden" name="id_jenis" value="{{ $item->id_jenis }}">
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label>Berat (kg)</label>
                                    <input type="number" step="0.01" name="berat" class="form-control berat-edit"
                                        data-id="{{ $item->id_setoran }}" value="{{ $item->berat }}" required>
                                </div>

                                <div class="col-md-4">
                                    <label>Poin</label>
                                    <input type="number" name="total_poin" id="poinEdit{{ $item->id_setoran }}"
                                        class="form-control" value="{{ $item->total_poin }}" readonly>
                                </div>

                                <div class="col-md-4">
                                    <label>Tanggal</label>
                                    <input type="date" class="form-control"
                                        value="{{ \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') }}" readonly>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <label>CO₂</label>
                                    <input type="number" name="total_co2" id="co2Edit{{ $item->id_setoran }}"
                                        class="form-control" value="{{ $item->total_co2 }}" readonly>
                                </div>

                                <div class="col-md-4">
                                    <label>Air</label>
                                    <input type="number" name="total_air" id="airEdit{{ $item->id_setoran }}"
                                        class="form-control" value="{{ $item->total_air }}" readonly>
                                </div>

                                <div class="col-md-4">
                                    <label>Energi</label>
                                    <input type="number" name="total_energi" id="energiEdit{{ $item->id_setoran }}"
                                        class="form-control" value="{{ $item->total_energi }}" readonly>
                                </div>
                            </div>

                        </div>

                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                                Batal
                            </button>
                            <button type="submit" class="btn-green">
                                Simpan
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    @endforeach

    <div class="modal fade" id="modalBerhasilTambah" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <div class="icon-circle-success">
                    <i class="bi bi-check-circle text-success fs-2"></i>
                </div>
                <h5>Data Berhasil Ditambahkan</h5>
                <p class="text-muted">Hadiah berhasil disimpan ke sistem.</p>
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
                <p class="text-muted">Hadiah berhasil disimpan ke sistem.</p>
                <button class="btn-green w-100" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalKonfirmasiHapus" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <div class="icon-circle-danger">
                    <i class="bi bi-exclamation-circle text-danger fs-2"></i>
                </div>
                <h5>Apakah Anda yakin?</h5>
                <p class="text-muted">Data tidak dapat dikembalikan</p>

                <div class="d-flex justify-content-center gap-3">
                    <button class="btn btn-outline-danger" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button class="btn-green" id="btnYaHapus">
                        Ya, Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $('#modalTambah').on('shown.bs.modal', function () {
            $('#modalTambah .select2').select2({
                dropdownParent: $('#modalTambah'),
                width: '100%'
            });
        });

        function hitung() {
            let berat = parseFloat($('#beratInput').val()) || 0;
            let opt = $('#jenisSelect option:selected');

            $('#poinAuto').val((berat * (opt.data('poin') || 0)).toFixed(2));
            $('#co2Auto').val((berat * (opt.data('co2') || 0)).toFixed(2));
            $('#airAuto').val((berat * (opt.data('air') || 0)).toFixed(2));
            $('#energiAuto').val((berat * (opt.data('energi') || 0)).toFixed(2));
        }

        $('#jenisSelect, #beratInput').on('change keyup', hitung);

        let idHapus = null;

        function showHapusModal(btn) {
            idHapus = btn.dataset.id;
            new bootstrap.Modal(
                document.getElementById('modalKonfirmasiHapus')
            ).show();
        }

        document.getElementById('btnYaHapus').addEventListener('click', function () {
            if (idHapus) {
                document.getElementById('formHapus' + idHapus).submit();
            }
        });

        $('.berat-edit').on('input', function () {
            let id = $(this).data('id');
            let berat = parseFloat($(this).val()) || 0;

            let modal = $('#modalEdit' + id);
            let opt = modal.find('.jenis-edit option:selected');

            $('#poinEdit' + id).val((berat * (opt.data('poin') || 0)).toFixed(2));
            $('#co2Edit' + id).val((berat * (opt.data('co2') || 0)).toFixed(2));
            $('#airEdit' + id).val((berat * (opt.data('air') || 0)).toFixed(2));
            $('#energiEdit' + id).val((berat * (opt.data('energi') || 0)).toFixed(2));
        });

        const formFilter = document.querySelector('form[action="{{ route('setoran.index') }}"]');

        document.querySelector('input[name="search"]').addEventListener('input', function () {
            clearTimeout(this.delay);
            this.delay = setTimeout(() => formFilter.submit(), 500);
        });

        document.querySelector('input[name="tanggal"]').addEventListener('change', function () {
            formFilter.submit();
        });

        document.querySelector('select[name="bulan"]').addEventListener('change', function () {
            formFilter.submit();
        });

        document.getElementById('btnRefresh').addEventListener('click', function () {
            window.location.href = "{{ route('setoran.index') }}";
        });

         document.addEventListener('DOMContentLoaded', function () {

        @if (session('tambah_success'))
            let modalTambah = new bootstrap.Modal(
                document.getElementById('modalBerhasilTambah')
            );
            modalTambah.show();
        @endif

        @if (session('edit_success'))
            let modalEdit = new bootstrap.Modal(
                document.getElementById('modalBerhasilEdit')
            );
            modalEdit.show();
        @endif

    });

    </script>

</body>

</html>