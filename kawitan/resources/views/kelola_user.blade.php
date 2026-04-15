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

        <div class="card shadow-sm ">
            <div class="card-body">

                <form method="GET">
                    <div class="d-flex align-items-center gap-2 mb-3">

                        <input type="text" name="search" class="form-control"
                            placeholder="Cari Data..."
                            style="width: 400px;"
                            value="{{ request('search') }}"
                            oninput="this.form.submit()">

                        <a href="{{ url('/kelola_user') }}" class="form-control btn-refresh">
                            <i class="bi bi-arrow-clockwise"></i>
                        </a>

                    </div>
                </form>

                <div class="table-wrapper">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pengguna</th>
                                <th>Email</th>
                                <th>No. Telepon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($users as $index => $user)
                                <tr>
                                    <td>{{ $users->firstItem() + $index }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->tlpn ?? '-' }}</td>
                                    <td>

                                        <button class="btn-action edit" data-bs-toggle="modal"
                                            data-bs-target="#modalEdit{{ $user->id_user }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>

                                        <button class="btn-action delete"
                                            data-id="{{ $user->id_user }}"
                                            onclick="showHapusModal(this)">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                        <form id="formHapus{{ $user->id_user }}"
                                            action="{{ route('admin.users.destroy', $user->id_user) }}"
                                            method="POST" class="d-none">
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
                            Showing {{ $users->firstItem() }}
                            to {{ $users->lastItem() }}
                            of {{ $users->total() }} results
                        </div>

                        <div class="table-footer-right">
                            {{ $users->links('pagination::bootstrap-5') }}
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    @foreach ($users as $user)
        <div class="modal fade" id="modalEdit{{ $user->id_user }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <form action="{{ route('admin.users.update', $user->id_user) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="modal-header border-0">
                            <h5 class="modal-title">Edit Data Pengguna</h5>
                        </div>

                        <div class="modal-body px-4">

                            <div class="mb-3">
                                <label class="form-label">Nama Pengguna</label>
                                <input type="text" name="username" class="form-control"
                                    value="{{ $user->username }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control"
                                    value="{{ $user->email }}" readonly>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">No. Telepon</label>
                                <input type="text" class="form-control"
                                    value="{{ $user->tlpn }}" readonly>
                            </div>

                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox"
                                    name="reset_password"
                                    id="reset{{ $user->id_user }}">
                                <label class="form-check-label" for="reset{{ $user->id_user }}">
                                    Reset Password ke default (password123)
                                </label>
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

    <div class="modal fade" id="modalKonfirmasiHapusUser" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center p-4">
                <div class="icon-circle-danger">
                    <i class="bi bi-exclamation-circle text-danger fs-2"></i>
                </div>
                <h5>Apakah Anda yakin?</h5>
                <p class="text-muted">Data pengguna yang dihapus tidak dapat dikembalikan.</p>

                <div class="d-flex justify-content-center gap-3">
                    <button class="btn btn-outline-danger" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button class="btn-green" id="btnYaHapusUser">
                        Ya, Saya Yakin
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalBerhasilEditUser" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-4">

            <div class="icon-circle-success mb-3">
                <i class="bi bi-check-circle text-success fs-1"></i>
            </div>

            <h5>Data Pengguna Berhasil Diperbarui</h5>
            <p class="text-muted">
                Perubahan data pengguna telah disimpan.
            </p>

            <button class="btn-green w-100" data-bs-dismiss="modal">
                OK
            </button>

        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            let idHapusUser = null;

            window.showHapusModal = function (btn) {
                idHapusUser = btn.dataset.id;
                new bootstrap.Modal(
                    document.getElementById('modalKonfirmasiHapusUser')
                ).show();
            };

            document.getElementById('btnYaHapusUser')?.addEventListener('click', function () {
                if (idHapusUser) {
                    document.getElementById('formHapus' + idHapusUser).submit();
                }
            });

        });
    </script>

    @if (session('edit_success'))
    <script>
    window.addEventListener('load', function () {
        new bootstrap.Modal(
            document.getElementById('modalBerhasilEditUser')
        ).show();
    });
    </script>
    @endif

</body>

</html>