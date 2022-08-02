<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Mariayo Inventory</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="assets/img/icon.ico" type="image/x-icon"/>
	
	<!-- Fonts and icons -->
	<script src="assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Open+Sans:300,400,600,700"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands"], urls: ['assets/css/fonts.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/azzara.min.css">

</head>
<body>
	<div class="wrapper">
		<!--
				Tip 1: You can change the background color of the main header using: data-background-color="blue | purple | light-blue | green | orange | red"
		-->
		<div class="main-header" data-background-color="red">
			<!-- Logo Header -->
			<div class="logo-header">
				
				<a href="#" class="logo">
					<img src="assets/img/logoazzara2.svg" alt="navbar brand" class="navbar-brand">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="fa fa-bars"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="fa fa-ellipsis-v"></i></button>
				<div class="navbar-minimize">
					<button class="btn btn-minimize btn-rounded">
						<i class="fa fa-bars"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg">
				
				<div class="container-fluid">
					<div class="collapse" id="search-nav">
						<form class="navbar-left navbar-form nav-search mr-md-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<button type="submit" class="btn btn-search pr-1">
										<i class="fa fa-search search-icon"></i>
									</button>
								</div>
								<input type="text" placeholder="Search ..." class="form-control">
							</div>
						</form>
					</div>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item toggle-nav-search hidden-caret">
							<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
								<i class="fa fa-search"></i>
							</a>
						</li>
				
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<li>
									<div class="user-box">
										<div class="avatar-lg"><img src="assets/img/profile.jpg" alt="image profile" class="avatar-img rounded"></div>
										<div class="u-text">
											<h4>{{ Auth::user()->name }}</h4>
											<p class="text-muted">{{ Auth::user()->email }}</p>
										</div>
									</div>
								</li>
								<li>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="#"><i class="fa fa-user"></i> My Profile</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="/logout"><i class="fa fa-lock"></i> Logout</a>
								</li>
							</ul>
						</li>
						
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>
		<!-- Sidebar -->
		<div class="sidebar">
			
			<div class="sidebar-wrapper scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="assets/img/profile.jpg" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#" aria-expanded="true">
								<span>
									{{ Auth::user()->name }}
									<span class="user-level">Level : {{ Auth::user()->level }}</span>
								</span>
							</a>
						</div>
					</div>
					<ul class="nav">
						<li class="nav-item">
							<a href="/home">
								<i class="fas fa-home"></i>
								<p>Dashboard</p>
								{{-- <span class="badge badge-count">5</span> --}}
							</a>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Components</h4>
						</li>

                        {{-- Dashboard Admin --}}
                        @if (Auth::user()->level == 'admin')
                        <li class="nav-item">
							<a data-toggle="collapse" href="#base">
								<i class="fas fa-layer-group"></i>
								<p>Data Master</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="base">
								<ul class="nav nav-collapse">
									<li>
										<a href="/user">
											<span class="sub-item">Data User</span>
										</a>
									</li>
                                    <li>
										<a href="/kategori">
											<span class="sub-item">Data Kategori</span>
										</a>
									</li>
                                    <li>
										<a href="/barang">
											<span class="sub-item">Data Barang</span>
										</a>
									</li>
								</ul>
							</div>
						</li>

                        <li class="nav-item">
							<a data-toggle="collapse" href="#laporan">
								<i class="fas fa-file"></i>
								<p>Data Laporan</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="laporan">
								<ul class="nav nav-collapse">
									<li>
										<a href="#">
											<span class="sub-item">Laporan</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
                        @endif

                        @if (Auth::user()->level == 'gudang' || Auth::user()->level == 'admin')
                            <li class="nav-item">
                                <a href="/barang_masuk">
                                    <i class="fas fa-briefcast"></i>
                                    <p>Barang Masuk</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/barang_keluar">
                                    <i class="fas fa-briefcast"></i>
                                    <p>Barang Keluar</p>
                                </a>
                            </li>
                        @endif

					</ul>
				</div>
			</div>
		</div>
		
		@yield('content')

		<!-- Custom template | don't include it in your project! -->
		<!-- End Custom template -->
	</div>
	<!--   Core JS Files   -->
	<script src="assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="assets/js/core/popper.min.js"></script>
	<script src="assets/js/core/bootstrap.min.js"></script>
	<!-- jQuery UI -->
	<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
	<!-- Bootstrap Toggle -->
	<script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
	<!-- jQuery Scrollbar -->
	<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
	<!-- Datatables -->
	<script src="assets/js/plugin/datatables/datatables.min.js"></script>
	<!-- Azzara JS -->
	<script src="assets/js/ready.min.js"></script>
	<!-- Azzara DEMO methods, don't include it in your project! -->
	<script src="assets/js/setting-demo.js"></script>
	
    <script >
		$(document).ready(function() {
			$('#add-row').DataTable({
			});

			
		});
	</script>

</body>
</html>