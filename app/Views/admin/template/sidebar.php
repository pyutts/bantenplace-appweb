<div class="sidebar sidebar-style-2">			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="<?= base_url('admin');?>/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
                </div>
                <div class="info">
                    <a aria-expanded="true">
                        <span>
                            <span><?= session()->get('username'); ?></span>
                            <span class="user-level"><?= session()->get('level'); ?></span>
                        </span>
                    </a>
                </div>
            </div>
            <ul class="nav nav-success">
                <li class="nav-item active">
                    <a href="<?= base_url('/dashboard'); ?>">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Menu</h4>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/dashboard/users'); ?>">
                        <i class="fas fa-user"></i>
                        <p>User</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/dashboard/manageproduct'); ?>">
                    <i class="fa-solid fa-cart-shopping"></i>
                        <p>Produk</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/dashboard/category'); ?>">
                        <i class="fas fa-th-list"></i>
                        <p>Kategori</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#base">
                        <i class="fas fa-bars"></i>
                        <p>Order</p>
                        <span class="caret"></span>
                    </a>
                    <!-- submenu nya -->
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="<?= base_url('/dashboard/managetransaction'); ?>">
                                    <span class="sub-item">Transaksi</span>
                                </a>
                                <a href="<?= base_url('/dashboard/managecart'); ?>">
                                    <span class="sub-item">Keranjang</span>
                                </a>
                                <a href="<?= base_url('/dashboard/orderdetail'); ?>">
                                    <span class="sub-item">Detail Order</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- end submenunya -->
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/dashboard/reports'); ?>">
                        <i class="far fa-chart-bar"></i>
                        <p>Laporan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/dashboard/managecontent'); ?>">
                        <i class="fas fa-pen-square"></i>
                        <p>Kelola Konten</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
