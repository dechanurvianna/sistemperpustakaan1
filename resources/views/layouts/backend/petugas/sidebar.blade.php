<style>
.sidebar {
    width: 220px;
    height: 100vh;
    background: linear-gradient(180deg, #021f4b, #021f4b);
    position: fixed;
    top: 0;
    left: 0;
    padding: 15px;
}

.sidebar h5 {
    color: #fff;
    font-weight: bold;
}

.sidebar .nav-link {
    color: #fff !important;
    margin-bottom: 8px;
    border-radius: 10px;
    padding: 10px 15px;
    display: block;
    text-decoration: none;
}

.sidebar .nav-link:hover {
    background: rgba(255,255,255,0.2);
}

.sidebar .nav-link.active {
    background: #17a2b8;
}
</style>

<div class="sidebar">
    <h5 class="mb-4">📚 Sistem Perpustakaan</h5>

    <ul class="nav flex-column">

        <li class="nav-item">
            <a href="{{ route('petugas.dashboard') }}"
            class="nav-link {{ request()->is('dashboard-petugas') ? 'active' : '' }}">
            🏠 Dashboard
        </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('petugas.data-buku') }}"
            class="nav-link {{ request()->is('petugas.data-buku') ? 'active' : '' }}">
                🔍 Data Buku
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('petugas.peminjaman.index') }}"
               class="nav-link {{ request()->is('petugas.peminjaman.index') ? 'active' : '' }}">
                📖 Data Peminjaman
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('petugas.pengembalian.index') }}"
               class="nav-link {{ request()->is('petugas.pengembalian.index') ? 'active' : '' }}">
                📥 Data Pengembalian
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('petugas.data-anggota') }}"
               class="nav-link {{ request()->is('petugas/data-anggota') ? 'active' : '' }}">
                📥 Data Anggota
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('petugas.profile') }}"
               class="nav-link {{ request()->is('petugas/profile*') ? 'active' : '' }}">
                👤 Profile
            </a>
        </li>

        <li class="nav-item mt-3">
            <a href="#" class="nav-link"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                🚪 Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>

    </ul>
</div>
