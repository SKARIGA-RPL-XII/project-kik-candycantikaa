<div class="sidebar">
    <div class="logo text-center">
        <img src="{{ asset('images/logo.png') }}" width="80">
    </div>

    <div class="menu">
        <a href="/dashboard_admin" class="{{ request()->is('dashboard_admin') ? 'active' : '' }}">
            <i class="bi bi-bar-chart"></i> Dashboard
        </a>

        <a href="{{ route('jenis-sampah.index') }}"
            class="{{ request()->routeIs('jenis-sampah.index') ? 'active' : '' }}">
            <i class="bi bi-recycle"></i> Kelola Jenis Sampah
        </a>

        <a href="{{ route('setoran.index') }}" class="{{ request()->routeIs('setoran.*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i> Kelola Setoran Sampah
        </a>


        <a href="{{ route('hadiah.index') }}" class="{{ request()->routeIs('hadiah.index') ? 'active' : '' }}">
            <i class="bi bi-recycle"></i> Kelola Hadiah
        </a>

        <a href="{{ route('kelola_user') }}" class="{{ request()->routeIs('kelola_user') ? 'active' : '' }}">
            <i class="bi bi-people"></i> Kelola Data Pengguna
        </a>


        <a href="/persetujuan" class="{{ request()->is('persetujuan') ? 'active' : '' }}">
            <i class="bi bi-check-circle"></i> Penukaran Poin
        </a>

        <a href="/poin_admin" class="{{ request()->is('poin_admin') ? 'active' : '' }}">
            <i class="bi bi-coin"></i> Laporan Poin
        </a>

        <a href="/eco_admin" class="{{ request()->is('eco_admin') ? 'active' : '' }}">
            <i class="bi bi-tree"></i> Laporan Eco Impact
        </a>

        <a href="/login" class="menu-logout">
            <i class="bi bi-box-arrow-right"></i> Keluar
        </a>
    </div>
</div>