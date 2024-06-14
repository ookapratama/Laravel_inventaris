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
                    <a href="{{route('dashboard.general')}}" class="nav-link "><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>

            <li class="menu-header">Activity Inventory</li>
            
            <li class="{{ Request::is('blank') ? 'active' : '' }}"><a class="nav-link" href="{{ route('blank') }}"><i class="fas fa-boxes"></i><span>Barang</span></a>
            </li>

            <li class="{{ Request::is('blank') ? 'active' : '' }}"><a class="nav-link" href="{{ route('blank') }}"><i class="fas fa-truck-loading"></i> <span>Barang Masuk</span></a>
            </li>

            <li class="{{ Request::is('blank') ? 'active' : '' }}"><a class="nav-link" href="{{ route('blank') }}"><i class="fas fa-outdent"></i> <span>Barang Keluar</span></a>
            </li>

            <li class="{{ Request::is('blank') ? 'active' : '' }}"><a class="nav-link" href="{{ route('blank') }}"><i class="fas fa-history"></i> <span>Riwayat Transaksi</span></a>
            </li>
           
        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-danger btn-lg btn-block btn-icon-split">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </aside>
</div>
