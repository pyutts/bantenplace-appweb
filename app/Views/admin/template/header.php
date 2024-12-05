<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Dashboard - Bantenplace</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="<?= base_url('admin');?>/img/icon.ico" type="image/x-icon"/>

    <!-- Fonts and icons -->
    <script src="<?= base_url('admin');?>/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Lato:300,400,700,900"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['<?= base_url('admin');?>/css/fonts.min.css']},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS Files -->
    <link rel="stylesheet" href="<?= base_url('admin');?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('admin');?>/css/atlantis.min.css">

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="<?= base_url('admin');?>/css/demo.css">
</head>
<body>
    <div class="wrapper">
    <div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="green">
				
				<a href="index.html" class="logo">
					<img src="<?= base_url('auth');?>/img/logowhite.png" alt="navbar brand" class="navbar-brand" height="25px">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>

            <nav class="navbar navbar-header navbar-expand-lg" data-background-color="green2">
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-bell"></i>
								<span class="notification">4</span>
							</a>
							<ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
								<li>
									<div class="dropdown-title">You have 4 new notification</div>
								</li>
								<li>
									<div class="notif-scroll scrollbar-outer">
										<div class="notif-center">
											<a href="#">
												<div class="notif-icon notif-primary"> <i class="fa fa-user-plus"></i> </div>
												<div class="notif-content">
													<span class="block">
														New user registered
													</span>
													<span class="time">5 minutes ago</span> 
												</div>
											</a>
										</div>
									</div>
								</li>
								<li>
									<a class="see-all" href="javascript:void(0);">See all notifications<i class="fa fa-angle-right"></i> </a>
								</li>
							</ul>
						</li>
						
						<li class="nav-item dropdown hidden-caret">
							<!-- Gambar Profil -->
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="<?= base_url('admin');?>/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<!-- Profil -->
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="<?= base_url('admin');?>/img/profile.jpg" alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4><font size="2"><?= session()->get('username'); ?></font></h4>
												<span class="text-muted"><font size="2"><b><?= session()->get('level'); ?></b></font></span>
											</div>
										</div>
									</li>
									<li>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="<?= base_url('logout');?>">Logout</a>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>   
    </div>

	<script src="<?= base_url('admin');?>/js/core/jquery.3.2.1.min.js"></script>
	<script src="<?= base_url('admin');?>/js/core/popper.min.js"></script>
	<script src="<?= base_url('admin');?>/js/core/bootstrap.min.js"></script>
	<script src="<?= base_url('admin');?>/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="<?= base_url('admin');?>/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
	<script src="<?= base_url('admin');?>/js/plugin/chart.js/chart.min.js"></script>
	<script src="<?= base_url('admin');?>/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>
	<script src="<?= base_url('admin');?>/js/plugin/chart-circle/circles.min.js"></script>
	<script src="<?= base_url('admin');?>/js/plugin/datatables/datatables.min.js"></script>
	<script src="<?= base_url('admin');?>/js/plugin/jqvmap/jquery.vmap.min.js"></script>
	<script src="<?= base_url('admin');?>/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>
	<script src="<?= base_url('admin');?>/js/plugin/sweetalert/sweetalert.min.js"></script>
	<script src="<?= base_url('admin');?>/js/atlantis.min.js"></script>
	<script src="<?= base_url('admin');?>/js/setting-demo.js"></script>
	<script src="<?= base_url('admin');?>/js/demo.js"></script>
	</body>
	</html>
