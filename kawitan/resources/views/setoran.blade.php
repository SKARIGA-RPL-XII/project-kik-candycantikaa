<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kelola Setoran Sampah</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="dashboard-page">

    @include('layout.sidebar_admin')
    @include('layout.header_admin')

    <div class="main-content">

        <div class="card shadow-sm mt-4">
            <div class="card-body">

                {{-- FILTER & SEARCH --}}
                <form method="GET" action="{{ route('setoran.index') }}" class="d-flex align-items-center gap-2 mb-3">

                    <input type="text" name="search" class="form-control rounded-pill px-3" placeholder="Cari Data..."
                        value="{{ request('search') }}" style="width:220px">

                    <input type="date" name="tanggal" class="form-control rounded-pill px-3"
                        value="{{ request('tanggal') }}" style="width:180px">

                    <select name="bulan" class="form-control rounded-pill px-3" style="width:160px">
                        <option value="">Pilih Bulan</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ sprintf('%02d', $i) }}" {{ request('bulan') == sprintf('%02d', $i) ? 'selected' : '' }}>
                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                            </option>
                        @endfor
                    </select>

                    <button class="btn btn-success rounded-pill px-4">
                        Cari
                    </button>

                    <a href="{{ route('setoran.index') }}"
                        class="btn btn-outline-secondary rounded-circle d-flex align-items-center justify-content-center"
                        style="width:40px;height:40px">
                        <i class="bi bi-arrow-clockwise"></i>
                    </a>
                </form>

                <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
                    + Tambah Setoran
                </button>

                {{-- TABLE --}}
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
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($setoran as $item)
                                <tr>
                                    <td>{{ $loop->iteration + ($setoran->currentPage() - 1) * $setoran->perPage() }}</td>
                                    <td>{{ $item->user->username }}</td>
                                    <td>{{ $item->jenis->nama_jenis }}</td>
                                    <td>{{ $item->berat }} kg</td>
                                    <td>{{ $item->total_poin }}</td>
                                    <td>{{ $item->total_co2 }}</td>
                                    <td>{{ $item->total_air }}</td>
                                    <td>{{ $item->total_energi }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>
                                        <button class="btn-action edit" data-id="{{ $item->id_setoran }}"
                                            data-bs-toggle="modal" data-bs-target="#modalEdit">
                                            <i class="bi bi-pencil"></i>
                                        </button>

                                        <button class="btn-action delete" data-id="{{ $item->id_setoran }}"
                                            data-bs-toggle="modal" data-bs-target="#modalHapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $setoran->links() }}

            </div>
        </div>
    </div>

    {{-- ================= MODAL TAMBAH ================= --}}
    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Setoran Sampah</h5>
                </div>

                <div class="modal-body">
                    <form id="formTambah">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nama Penyetor</label>
                            <select name="id_user" class="form-control select2">
                                <option></option>
                                @foreach($users as $u)
                                    <option value="{{ $u->id_user }}">{{ $u->username }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Sampah</label>
                            <select name="id_jenis" class="form-control select2">
                                @foreach($jenisSampah as $j)
                                    <option value="{{ $j->id_jenis }}">{{ $j->nama_jenis }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Berat (kg)</label>
                            <input type="number" step="0.01" name="berat" id="beratInput" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" readonly>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label>Poin</label>
                                <input type="number" id="poinAuto" class="form-control" readonly>
                            </div>
                            <div class="col-md-4">
                                <label>CO₂</label>
                                <input type="number" id="co2Auto" class="form-control" readonly>
                            </div>
                            <div class="col-md-4">
                                <label>Air</label>
                                <input type="number" id="airAuto" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="mt-3">
                            <label>Energi</label>
                            <input type="number" id="energiAuto" class="form-control" readonly>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-outline-danger" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-success" id="btnSimpanTambah">Simpan</button>
                </div>

            </div>
        </div>
    </div>

    {{-- ================= MODAL HAPUS ================= --}}
    <div class="modal fade" id="modalHapus" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <h5>Yakin hapus data?</h5>
                <div class="mt-3">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-danger" id="btnHapus">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    {{-- JS --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $('#modalTambah').on('shown.bs.modal', function () {
            $('#modalTambah .select2').select2({
                dropdownParent: $('#modalTambah'),
                width: '100%',
                placeholder: 'Pilih Nama Penyetor',
                allowClear: true
            });
        });
        $('#modalEdit').on('shown.bs.modal', function () {
            $('#modalEdit .select2').select2({
                dropdownParent: $('#modalEdit'),
                width: '100'
            });
        });

        let deleteId = null;
        $('.delete').click(function () {
            deleteId = $(this).data('id');
        });

        $('#btnHapus').click(function () {
            $.ajax({
                url: '/setoran/' + deleteId,
                type: 'POST',
                data: {
                    _token: $('meta[name=csrf-token]').attr('content'),
                    _method: 'DELETE'
                },
                success: () => location.reload()
            });
        });
    </script>

</body>

</html>