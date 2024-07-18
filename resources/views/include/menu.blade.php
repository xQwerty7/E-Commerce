<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
            <a href="#" class="nav-link active  @if (request()->is('pembelian*') ||
                    // request()->is('Banner*') ||
                    request()->is('penjualan*') ||
                    request()->is('pemasok*') ||
                    request()->is('stok*')) active @endif">
                <i class='bx bx-home-smile'></i>
                <p>
                    Home
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ url('pembelian') }}" class="nav-link @if (session('active_session') === 'pembelian') active @endif">
                        <i class="bx bxs-grid -bottom-3"></i>
                        <p>Pembelian</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('penjualan') }}" class="nav-link @if (session('active_session') === 'penjualan') active @endif">
                        <i class="bx bxs-grid -bottom-3"></i>
                        <p>penjualan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('pemasok') }}" class="nav-link @if (session('active_session') === 'pemasok') active @endif">
                        <i class="bx bxs-grid -bottom-3"></i>
                        <p>pemasok</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('stok') }}" class="nav-link @if (session('active_session') === 'stok') active @endif">
                        <i class='bx bxs-grid'></i>
                        <p>stok</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
