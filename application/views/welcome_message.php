<!DOCTYPE html>
<html>

<head>
	<title>Log Image</title>
	<link rel="icon" href="<?= base_url('assets/img/logo.png') ?>">
	<link href="<?= base_url('/assets/css/vendor.min.css') ?>" rel="stylesheet" />
	<link href="<?= base_url('/assets/css/facebook/app.min.css') ?>" rel="stylesheet" />
	<link href="<?= base_url('/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css') ?>" rel="stylesheet" />
	<link href="<?= base_url('/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') ?>" rel="stylesheet" />
	<link href="<?= base_url('/assets/plugins/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') ?>" rel="stylesheet" />

	<link href="<?= base_url('assets/plugins/jvectormap-next/jquery-jvectormap.css ') ?>" rel="stylesheet" />
	<link href="<?= base_url('assets/plugins/nvd3/build/nv.d3.css ') ?>" rel="stylesheet" />
	<link href="<?= base_url('assets/plugins/bootstrap-daterangepicker/daterangepicker.css ') ?>" rel="stylesheet" />
	<style>
		.card {
			flex-direction: row;
			align-items: center;
		}

		#message {
			text-align: center;
			line-height: 400px;
		}

		.card-title {
			font-weight: bold;
		}

		.card img {
			width: 30%;
			border-top-right-radius: 0;
			border-bottom-left-radius: calc(0.25rem - 1px);
		}

		@media only screen and (max-width: 768px) {
			a {
				display: none;
			}

			.card-body {
				padding: 0.5em 1.2em;
			}

			.card-body .card-text {
				margin: 0;
			}

			.card img {
				width: 50%;
			}
		}

		@media only screen and (max-width: 1200px) {
			.card img {
				width: 40%;
			}
		}

		.indicator {
			position: absolute;
			top: 0px;
			right: 0px;
			display: flex;
			align-items: center;
		}

		.status-circle {
			width: 20px;
			height: 20px;
			border-radius: 10px;
			margin-right: 5px;
		}

		.status {
			font-size: 18px;
			font-weight: bold;
		}
	</style>
</head>

<body style="background-color:midnightblue; margin:80px; overflow: hidden;">

	<div class="container">
		<div class="card" style="width: 100%; height: 60vh;">
			<div class="indicator" style="margin: 5px;" class="m-3">
				<div id="status-circle" class="status-circle"></div>
				<span id="status" class="status"></span>
			</div>
			<img id="image" style="display: none; height:100%;" src="" class="card-img-top" alt="...">
			<div class="card-body">
				<h1 id="message" class="text-center">ABSENSI UNIGUARD</h1>

				<h1 id="res-title" class="card-text"></h1>
				<h2 id="res-name" class="card-title"></h2>
				<h2 id="res-type" class="card-text"></h2>

			</div>
		</div>
	</div>

	<script>
		let lastImageUrl = '';
		let intervalId;
		let timeoutId;
		let isImageShown = false;
		let time = 0;

		document.addEventListener("DOMContentLoaded", function() {
			intervalId = setInterval(fetchData, 500);
		});

		function fetchData() {
			var now = new Date();

			fetch('<?= base_url('api/last_log/' . $id) ?>')
				.then(response => response.json())
				.then(data => {
				    console.log(data)
					var compareDate = new Date(data.device.time);
					if (Math.abs((new Date().getTime() - new Date(data.device.time_heartbeat)) / 1000) > 500) {
						document.getElementById("status").innerHTML = "Offline";
						document.getElementById("status-circle").style.backgroundColor = 'red';
					} else {
						document.getElementById("status").innerHTML = "Online";
						document.getElementById("status-circle").style.backgroundColor = 'green';
					}
					if (Math.abs((new Date().getTime() - new Date(data.device.time)) / 1000) < 20) {
						console.log('kurang dr 20')

						if (data.data) {
							lastImageUrl = data.device.image;
							document.getElementById("message").innerHTML = '';
							document.getElementById("image").src = data.device.image;
							document.getElementById("image").style.display = 'block';
							document.getElementById("image").style.height = '100%';
							document.getElementById("image").style.width = '25%';
							document.getElementById("image").style.marginLeft = '10%';
							document.getElementById("image").style.marginBottom = '5%';
							isImageShown = true;
							// Tampilkan respon
							if (data.device.operator === 'VerifyPush') {
								document.getElementById("res-title").innerHTML = '<?= $this->db->get_where('settings', array('name' => 'school_name'))->row_array()['value'] ?>';
								document.getElementById("res-title").style.marginBottom = '10px';
								document.getElementById("res-title").style.textAlign = 'center';
								document.getElementById("res-name").innerHTML = data.device.employee_name;
								document.getElementById("res-name").style.textAlign = 'center';
								type = data.device.attendance_status + " (" + data.device.attendance_time + ")"
								// if (data.type == 'karyawan') {
								// 	type = 'jabatan : ' + data.data.jabatan
								// } else {
								// 	type = 'Jabatan : ' + data.data.jabatan

								// }
								document.getElementById("res-type").innerHTML = type
								document.getElementById("res-type").style.textAlign = 'center';
							} else {
								document.getElementById("res-type").innerHTML = 'TIDAK TERDAFTAR'
								document.getElementById("res-type").style.textAlign = 'center';

							}



							clearTimeout(timeoutId);
							timeoutId = setTimeout(hideImage, 2000);
							time = 0;
						}
					}
				});
		}

		function hideImage() {
			document.getElementById("image").style.display = 'none';
			isImageShown = false;
			document.getElementById("message").innerHTML = 'Welcome';
			document.getElementById("res-type").innerHTML = '';
			document.getElementById("res-name").innerHTML = '';
			document.getElementById("res-title").innerHTML = '';

		}
	</script>


</body>

</html>