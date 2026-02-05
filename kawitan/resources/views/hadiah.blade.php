<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kelola Hadiah</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="dashboard-page">

@section('judulheader', 'Kelola Hadiah')
@section('keteranganheader', 'Daftar Hadiah')

@include('layout.sidebar_admin')
@include('layout.header_admin')

<div class="main-content">

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center search-button-table">
                <div class="d-flex gap-2">
                    <input type="text" id="searchText" class="form-control" placeholder="Cari Data..." style="width:320px;">
                    <button id="btnRefresh" class="form-control btn-refresh">
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

                        @foreach ($hadiah as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $item->gambar) }}" width="48">
                            </td>
                            <td>{{ $item->nama_hadiah }}</td>
                            <td>{{ $item->poin_dibutuhkan }}</td>
                            <td>{{ $item->stok }}</td>
                            <td>{{ $item->deskripsi }}</td>
                            <td>
                                <button class="btn-action edit" data-bs-toggle="modal"
                                    data-bs-target="#modalEdit{{ $item->id_hadiah }}">
                                    <i class="bi bi-pencil"></i>
                                </button>

                                <button class="btn-action delete"
                                    data-id="{{ $item->id_hadiah }}"
                                    onclick="showHapusModal(this)">
                                    <i class="bi bi-trash"></i>
                                </button>

                                <form id="formHapus{{ $item->id_hadiah }}"
                                      action="{{ route('hadiah.destroy', $item->id_hadiah) }}"
                                      method="POST" class="d-none">
                                    @csrf
                                </form>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<!-- modal tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <form action="{{ route('hadiah.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-header border-0">
                    <h5 class="modal-title">Tambah Hadiah</h5>
                </div>

                <div class="modal-body px-4">
                    <div class="mb-3">
                        <label>Gambar</label>
                        <input type="file" name="gambar" class="form-control" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nama</label>
                            <input type="text" name="nama_hadiah" class="form-control" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Poin</label>
                            <input type="number" name="poin_dibutuhkan" class="form-control" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Stok</label>
                            <input type="number" name="stok" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
                    </div>
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

<!-- modal edit -->
@foreach ($hadiah as $item)
<div class="modal fade" id="modalEdit{{ $item->id_hadiah }}" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <form action="{{ route('hadiah.update', $item->id_hadiah) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-header border-0">
                    <h5 class="modal-title">Edit Hadiah</h5>
                </div>

                <div class="modal-body px-4">

                    <div class="mb-3">
                        <label>Gambar</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nama</label>
                            <input type="text" name="nama_hadiah"
                                   value="{{ $item->nama_hadiah }}" class="form-control" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Poin</label>
                            <input type="number" name="poin_dibutuhkan"
                                   value="{{ $item->poin_dibutuhkan }}" class="form-control" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label>Stok</label>
                            <input type="number" name="stok"
                                   value="{{ $item->stok }}" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="4" required>{{ $item->deskripsi }}</textarea>
                    </div>

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

<!-- modal hapus -->
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

<div class="modal fade" id="modalBerhasilHapus" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-4">
            <div class="icon-circle-danger">
                <i class="bi bi-trash text-danger fs-2"></i>
            </div>
            <h5>Data Berhasil Dihapus</h5>
            <p class="text-muted">Data telah dihapus dari sistem.</p>
            <button class="btn-green w-100" data-bs-dismiss="modal">OK</button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
let idHapus = null;

function showHapusModal(btn) {
    idHapus = btn.dataset.id;
    new bootstrap.Modal(document.getElementById('modalKonfirmasiHapus')).show();
}

document.getElementById('btnYaHapus').addEventListener('click', function () {
    if (idHapus) {
        document.getElementById('formHapus' + idHapus).submit();
    }
});

// SEARCH
document.getElementById('searchText').addEventListener('input', function () {
    let v = this.value.toLowerCase();
    document.querySelectorAll('#tableBody tr').forEach(r => {
        r.style.display = r.textContent.toLowerCase().includes(v) ? '' : 'none';
    });
});

document.getElementById('btnRefresh').addEventListener('click', function () {
    searchText.value = '';
    document.querySelectorAll('#tableBody tr').forEach(r => r.style.display = '');
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
