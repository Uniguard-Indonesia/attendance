<?php $this->load->view('layout/head') ?>
<div id="app" class="app app-header-fixed app-sidebar-fixed ">
	<?php $this->load->view('layout/header') ?>
	<?php $this->load->view('layout/sidebar') ?>
	<div id="content" class="app-content">
		<!-- BEGIN breadcrumb -->
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
			<li class="breadcrumb-item active"><?= $title ?></li>
		</ol>
		<!-- END breadcrumb -->
		<!-- BEGIN page-header -->
		<h1 class="page-header"><?= $title ?></h1>
		<!-- END page-header -->

		<!-- BEGIN row -->
		<div class="row">
			<!-- BEGIN col-3 -->
			<div class="col-xl-4 col-md-6">
				<div class="widget widget-stats bg-blue">
					<div class="stats-icon"><i class="fa fa-desktop"></i></div>
					<div class="stats-info">
						<h4>TOTAL USERS</h4>
						<p><?= $users ?></p>
					</div>
					<div class="stats-link">
						<a href="<?= base_url('users') ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
					</div>
				</div>
			</div>
			<!-- END col-3 -->
			<!-- BEGIN col-3 -->
			<div class="col-xl-4 col-md-6">
				<div class="widget widget-stats bg-info">
					<div class="stats-icon"><i class="fa fa-link"></i></div>
					<div class="stats-info">
						<h4>TOTAL jabatan</h4>
						<p><?= $positions ?></p>
					</div>
					<div class="stats-link">
						<a href="<?= base_url('positions') ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
					</div>
				</div>
			</div>
			<!-- END col-3 -->
			<!-- BEGIN col-3 -->
			
			<!-- END col-3 -->
			<!-- BEGIN col-3 -->
			<div class="col-xl-4 col-md-6">
				<div class="widget widget-stats bg-red">
					<div class="stats-icon"><i class="fa fa-clock"></i></div>
					<div class="stats-info">
						<h4>TOTAL karyawan</h4>
						<p><?= $employees ?></p>
					</div>
					<div class="stats-link">
						<a href="<?= base_url('employees') ?>">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
					</div>
				</div>
			</div>
			<!-- END col-3 -->
		</div>
		<!-- END row -->
		<div class="row">
			<!-- BEGIN col-8 -->
			<div class="col-xl-8 col-lg-6">
				<!-- BEGIN card -->
				<div class="card border-0 mb-3">
					<div class="card-body">
						<div class="mb-3 "><b>Absensi ANALYTICS</b> <span class="ms-2"><i class="fa fa-info-circle" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-title="Top products with units sold" data-bs-placement="top" data-bs-content="Products with the most individual units sold. Includes orders from all sales channels." data-original-title="" title=""></i></span></div>
					</div>
					<div class="card-body p-0">
						<div>
							<div id="apex-line-chart" class="widget-chart-full-width nvd3-inverse-mode" style="height: 254px"></div>
						</div>
					</div>
				</div>
				<!-- END card --> 
			</div>
			<div class="col-xl-4 col-lg-6">
				<!-- BEGIN card -->
				<div class="card border-0 mb-3 ">
					<!-- BEGIN card-body -->
					<div class="card-body" >
						<!-- BEGIN title -->
						<div class="mb-3 ">
							<b>Absen Hari Ini</b>
							<span class="ms-2"><i class="fa fa-info-circle" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-title="Marketing Campaign" data-bs-placement="top" data-bs-content="Campaign that run for getting more returning customers."></i></span>
						</div>

							
						<hr class="bg-white-transparent-2 mt-20px mb-20px" /> 
						<div class="row align-items-center" style="height: 235px" > 
							<div class="col-4">
								<div class="h-100px d-flex align-items-center justify-content-center">
									<img src="<?= 'https://smartschoolintegrated.com/assets/img/employee.png' ?>" class="mw-100 mh-100" />
								</div>
							</div> 
							<div class="col-8">
								<div class="mb-2px text-truncate">employee</div>
								<div class="mb-2px  fs-11px"><?= date('l, d M Y') ?></div>
								<div class="d-flex align-items-center mb-2px">
									<div class="flex-grow-1">
										<div class="progress h-5px rounded-pill bg-white-transparent-1">
											<div class="progress-bar progress-bar-striped bg-warning" data-animation="width" data-value="<?= $employees != 0 ? ($nowemployee / $employees) * 100 : 0; ?>%" style="width: <?= $employees != 0 ? '0%' : '100%'; ?>"></div>
										</div>
									</div>
									<div class="ms-2 fs-11px w-30px text-center"><span data-animation="number" data-value="<?= round(($nowemployee / ($employees != 0 ? $employees : 1)) * 100, 0); ?>">0</span>%</div>
								</div>
								<div class=" fs-11px mb-15px text-truncate">
									<?= $nowemployee ?> / <?= $employees ?>
								</div>
								<a href="<?= base_url('employee_attandances') ?>" class="btn btn-xs btn-warning fs-10px ps-2 pe-2">Detail</a>
							</div>

							<!-- END col-8 -->
						</div>
						<!-- END row -->
					</div>
					<!-- END card-body -->
				</div>
				<!-- END card -->
			</div>
		</div>

		<!-- END row -->
	</div>
</div>
<?php $this->load->view('layout/foot') ?>