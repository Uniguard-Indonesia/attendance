<?php $this->load->view('layout/head') ?>

<div class="wrapper">
	<div class="main">

		<main class="d-flex w-100 h-100">
			<div class="container d-flex flex-column">
				<div class="row vh-100">
					<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
						<div class="d-table-cell align-middle">

							<div class="card">
								<div class="card-head">
									<div class="text-center mt-4">
										<h1 class="h2"><i class="align-middle me-2 fas fa-fw fa-credit-card"></i>Login <b>Absensi</b> </h1>
									</div>
								</div>
								<div class="card-body">
									<div class="m-sm-4">
										<form method="post" action="<?= base_url('auth/login') ?>">
											
											<?= $this->session->flashdata('message'); ?>

											<div class="mb-3">
												<label for="username" class="form-label ">Username</label>
												<input type="text" autocomplete="off" class="form-control" name="username" id="username" placeholder="Username">
												<span class="text-danger">
													<?= form_error('username') ?>
												</span>

											</div>
											<div class="mb-3">
												<label class="form-label">Password</label>
												<input autocomplete="off" class="form-control" type="password" name="password" placeholder="Password">
												<div class="text-danger">
													<?= form_error('password') ?>
												</div>
											</div>
											<div class="text-center mt-3">
												<div class="d-grid gap-2">
													<button class="btn btn-success" type="submit">Login</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</main>

	</div>
</div>

<?php $this->load->view('layout/foot') ?>