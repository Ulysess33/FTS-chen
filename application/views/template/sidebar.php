<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
            <i class="fas fa-user"></i>
        </div>
        <div class="sidebar-brand-text mx-3">PRB Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= $this->uri->segment(1) == 'dashboard' ? 'active' : null ?>">
        <a class="nav-link" href="<?= base_url('dashboard') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?= $this->uri->segment(1) == 'datapenjualan' ||  $this->uri->segment(1) == 'databarang' ||  $this->uri->segment(1) == 'dh_bulanan' ? 'active' : null ?>">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Penjualan</span>
        </a>
        <div id="collapsePages" class="collapse <?= $this->uri->segment(1) == 'datapenjualan' ||  $this->uri->segment(1) == 'databarang' ||  $this->uri->segment(1) == 'dh_bulanan' ? 'show' : null ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header"></h6>
                <a class="collapse-item <?= $this->uri->segment(1) == 'datapenjualan' ? 'active' : null ?>" href="<?= base_url('datapenjualan') ?>">Data Penjualan</a>
                <a class="collapse-item <?= $this->uri->segment(1) == 'databarang' ? 'active' : null ?>" href="<?= base_url('databarang') ?>">Data Barang</a>
                <a class="collapse-item <?= $this->uri->segment(1) == 'dh_bulanan' ? 'active' : null ?>" href="<?= base_url('dh_bulanan') ?>">Data History Bulanan</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - prediksi -->
    <li class="nav-item <?= $this->uri->segment(1) == 'prediksi' ||  $this->uri->segment(1) == 'hasilpredik' ||  $this->uri->segment(1) == 'datapredik' ? 'active' : null ?>">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages2" aria-expanded="true" aria-controls="collapsePages2">
            <i class="fas fa-fw fa-folder"></i>
            <span>Prediksi Penjualan</span>
        </a>
        <div id="collapsePages2" class="collapse <?= $this->uri->segment(1) == 'prediksi' ||  $this->uri->segment(1) == 'hasilpredik' ||  $this->uri->segment(1) == 'datapredik' ? 'show' : null ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Prediksi penjualan</h6>
                <a class="collapse-item <?= $this->uri->segment(1) == 'prediksi' ? 'active' : null ?>" href="<?= base_url('prediksi') ?>">Proses Prediksi</a>
                <a class="collapse-item <?= $this->uri->segment(1) == 'hasilpredik' ? 'active' : null ?>" href="<?= base_url('hasilpredik') ?>">Prediksi Penjualan</a>
                <a class="collapse-item <?= $this->uri->segment(1) == 'datapredik' ? 'active' : null ?>" href="<?= base_url('datapredik') ?>">Data Hasil Prediksi</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item <?= $this->uri->segment(1) == 'statistik' ? 'active' : null ?>">
        <a class="nav-link" href="<?= base_url('statistik') ?>">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Statistik Penjualan</span></a>
    </li>

    <!-- Nav Item - Tables --
            <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li>

            <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>