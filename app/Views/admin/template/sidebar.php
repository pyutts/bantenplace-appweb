<div class="sidebar sidebar-style-2">			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                <?php
				    $userImage = session()->get ('profil_gambar');

					$filePath = FCPATH . $userImage;

					if ($userImage && file_exists($filePath)) {
						$imageSrc = base_url($userImage);
					} else {
						$imageSrc = base_url('/uploads/default/default_user.png');
					}
					?>
                    <img src="<?= esc($imageSrc) ?>" alt="..." class="avatar-img rounded-circle">
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
                    <a href="<?= base_url('/dashboard/products'); ?>">
                    <i class="fas fa-box"></i>
                        <p>Produk</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/dashboard/categories'); ?>">
                        <i class="fas fa-list"></i>
                        <p>Kategori Produk</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('/dashboard/orders'); ?>">
                        <i class="fas fa-shopping-cart"></i>
                        <p>Pesanan</p>
                    </a>
                 </li>
                 <li class="nav-item">
                    <a href="<?= base_url('/dashboard/payments'); ?>">
                        <i class="fas fa-credit-card"></i>
                        <p>Pembayaran</p>
                    </a>
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
