<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="/">St</a>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown {{ $menu == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="nav-link "><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>

            <li class="menu-header">Activity Inventory</li>

            <li class="{{ $menu == 'barang' ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('barang.index') }}"><i class="fas fa-boxes"></i><span>Barang</span></a>
            </li>

            <li class="{{ $menu == 'pemasukan' ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('masuk.index') }}"><i class="fas fa-truck-loading"></i> <span>Barang Masuk</span></a>
            </li>

            <li class="{{ $menu == 'keluar' ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('keluar.index') }}"><i class="fas fa-outdent"></i> <span>Barang Keluar</span></a>
            </li>

            <li class="{{ $menu == 'transaksi' ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('transaksi.index') }}"><i class="fas fa-history"></i> <span>Transaksi
                        Barang</span></a>
            </li>

        </ul>
        @if (session('role') == 'superadmin')
            <ul class="sidebar-menu">

                <li class="menu-header">Our Activity</li>

                <li class="{{ $menu == 'kategori' ? 'active' : '' }}"><a class="nav-link"
                        href="{{ route('kategori.index') }}"><i class="fas fa-list"></i><span>Kategori</span></a>
                </li>

                <li class="{{ $menu == 'user' ? 'active' : '' }}"><a class="nav-link"
                        href="{{ route('user.index') }}"><i class="fas fa-users"></i><span>User</span></a>
                </li>

            </ul>
        @endif

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="{{ route('logout') }}" class="btn btn-danger btn-lg btn-block btn-icon-split">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </aside>
</div>
