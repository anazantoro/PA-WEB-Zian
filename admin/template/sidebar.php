<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="dashboard.php"><i class="far fas fa-car-side"></i> CleanCars</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="dashboard.php">CC</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown <?= activeLink("dashboard.php") ?>">
                <a href="dashboard.php" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Data List</li>
            <?php if (visible("admin|manager", $data['status'])) : ?>
                <li class="dropdown <?= activeLink("pegawai.php/pencuci.php/group.php") ?>">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-user"></i> <span>Karyawan</span></a>
                    <ul class="dropdown-menu">
                        <li class="<?= activeLink("pegawai.php") ?>"><a href="pegawai.php">Pegawai</a></li>
                        <li class="<?= activeLink("pencuci.php") ?>"><a href="pencuci.php">Pencuci</a></li>
                        <li class="<?= activeLink("group.php") ?>"><a href="group.php">Group Pencuci</a></li>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if (visible("admin|manager|kasir", $data['status'])) : ?>
                <li class="dropdown <?= activeLink("mobil.php/mobilCustomer.php") ?>">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-car"></i> <span>Mobil</span></a>
                    <ul class="dropdown-menu">
                        <li class="<?= activeLink("mobil.php") ?>"><a href="mobil.php">Mobil</a></li>
                        <li class="<?= activeLink("mobilCustomer.php") ?>"><a href="mobilCustomer.php">Mobil Customer</a></li>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if (visible("admin|manager", $data['status'])) : ?>
                <li class="dropdown <?= activeLink("paket.php") ?>">
                    <a href="paket.php" class="nav-link"><i class="fas fa-box"></i><span>Paket Pencucian</span></a>
                </li>
            <?php endif; ?>
            <li class="menu-header">Market</li>
            <?php if (visible("admin|kasir", $data['status'])) : ?>
                <li class="dropdown <?= activeLink("antrian.php") ?>">
                    <a href="antrian.php" class="nav-link"><i class="fas fa-user-friends"></i><span>Antrian</span></a>
                </li>
            <?php endif; ?>
            <?php if (visible("admin|kasir", $data['status'])) : ?>
                <li class="dropdown <?= activeLink("transaksi.php") ?>">
                    <a href="transaksi.php" class="nav-link"><i class="fas fa-coins"></i><span>Transaksi</span></a>
                </li>
            <?php endif; ?>
            <?php if (visible("admin|manager|kasir", $data['status'])) : ?>
                <li class="dropdown <?= activeLink("pesan.php") ?>">
                    <a href="pesan.php" class="nav-link"><i class="fas fa-envelope"></i><span>Pesan Customer</span></a>
                </li>
            <?php endif; ?>
            <li class="menu-header">History</li>
            <?php if (visible("admin|manager|kasir", $data['status'])) : ?>
                <li class="dropdown <?= activeLink("historyMobil.php/historyPegawai.php/historyPaket.php/historyAntrian.php/historyTransaksi.php") ?>">
                    <a href="history.php" class="nav-link has-dropdown"><i class="fas fa-history"></i> <span>History</span></a>
                    <ul class="dropdown-menu">
                        <li class="<?= activeLink("historyMobil.php") ?>"><a href="historyMobil.php">History Mobil</a></li>
                        <li class="<?= activeLink("historyPegawai.php") ?>"><a href="historyPegawai.php">History Pegawai</a></li>
                        <li class="<?= activeLink("historyPaket.php") ?>"><a href="historyPaket.php">History Paket</a></li>
                        <li class="<?= activeLink("historyAntrian.php") ?>"><a href="historyAntrian.php">History Antrian</a></li>
                        <li class="<?= activeLink("historyTransaksi.php") ?>"><a href="historyTransaksi.php">History Transaksi</a></li>
                    </ul>
                </li>
            <?php endif; ?>
        </ul>
    </aside>
</div>