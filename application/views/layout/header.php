<div id="header" class="app-header app-header-inverse">
	<!-- BEGIN navbar-header -->
	<div class="navbar-header">
		<a href="index.html" class="navbar-brand"><i class="fa fa-address-card fa-lg"></i> Absensi</a>
		<button type="button" class="navbar-mobile-toggler" data-toggle="app-sidebar-mobile">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
	</div>
	<!-- END navbar-header -->
	<!-- BEGIN header-nav -->
	<div class="navbar-nav">

		<div class="navbar-item navbar-user dropdown">
			<a href="#" class="navbar-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
				<img src="<?= base_url('/assets/img/uploads/' . $this->session->userdata('foto')) ?? ''  ?>" alt="" />
				<span class="d-none d-md-inline"><?= $this->session->userdata('name') ?></span> <b class="caret ms-6px"></b>
			</a>
			<div class="dropdown-menu dropdown-menu-end me-1">
				<a href="<?= base_url('settings') ?>" class="dropdown-item">Setting</a>
				<div class="dropdown-divider"></div>
				<a href="<?= base_url('auth/logout') ?>" class="dropdown-item">Log Out</a>
			</div>
		</div>
	</div>
	<!-- END header-nav -->
</div>