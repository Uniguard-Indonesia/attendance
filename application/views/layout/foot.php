	<!-- ================== BEGIN core-js ================== -->
	<script src="<?= base_url('assets/js/vendor.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/app.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/theme/facebook.min.js') ?>"></script>
	<!-- ================== END core-js ================== -->

	<!-- ================== BEGIN page-js ================== -->
	<script src="<?= base_url('assets/plugins/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/datatables.net-buttons/js/buttons.colVis.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/datatables.net-buttons/js/buttons.flash.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/datatables.net-buttons/js/buttons.html5.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/datatables.net-buttons/js/buttons.print.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/pdfmake/build/pdfmake.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/pdfmake/build/vfs_fonts.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/jszip/dist/jszip.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/demo/table-manage-buttons.demo.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/@highlightjs/cdn-assets/highlight.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/demo/render.highlight.js') ?>"></script>

	<script src="<?= base_url('assets/plugins/d3/d3.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/nvd3/build/nv.d3.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/jvectormap-next/jquery-jvectormap.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/jvectormap-next/jquery-jvectormap-world-mill.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/apexcharts/dist/apexcharts.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/moment/min/moment.min.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') ?>"></script>
	<!-- <script src="<?= base_url('assets/js/demo/dashboard-v3.js') ?>"></script> -->

	<script src="<?= base_url('assets/plugins/gritter/js/jquery.gritter.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/sweetalert/dist/sweetalert.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/demo/ui-modal-notification.demo.js') ?>"></script>
	<script src="<?= base_url('assets/plugins/@highlightjs/cdn-assets/highlight.min.js') ?>"></script>
	<script src="<?= base_url('assets/js/demo/render.highlight.js') ?>"></script>
	<!-- ================== END page-js ================== -->
	<script>
	    var chart = new ApexCharts(
	        document.querySelector('#apex-line-chart'), {
	            chart: {
	                height: 248,
	                type: 'line',
	                shadow: {
	                    enabled: true,
	                    color: COLOR_DARK,
	                    top: 18,
	                    left: 7,
	                    blur: 10,
	                    opacity: 1
	                },
	                toolbar: {
	                    show: false
	                }
	            },
	            title: {
	                text: 'Attandance',
	                align: 'center'
	            },
	            //   colors: [COLOR_BLUE, COLOR_TEAL],
	            dataLabels: {
	                enabled: true,
	                style: {
	                    colors: ['']
	                }
	            },

	            stroke: {
	                curve: 'smooth',
	                width: 3
	            },
	            series: [{
	                    name: 'employee',
	                    data: JSON.parse('<?= $employee_data ?>')
	                },
	              
	            ],

	            markers: {
	                size: 4
	            },
	            xaxis: {
	                categories: JSON.parse('<?= $categories ?>'),
	                // axisBorder: { show: true, color: COLOR_SILVER_TRANSPARENT_5, height: 1, width: '100%', offsetX: 0, offsetY: -1 },
	                // axisTicks: { show: true, borderType: 'solid', color: COLOR_SILVER, height: 6, offsetX: 0, offsetY: 0 }
	            },
	            legend: {
	                show: true,
	                position: 'top',
	                offsetY: -10,
	                horizontalAlign: 'right',
	                floating: true
	            }
	        }
	    );

	    chart.render();
	</script>
	<script>
	    function checkAll(ele) {
	        var checkboxes = document.getElementsByTagName('input');
	        if (ele.checked) {
	            for (var i = 0; i < checkboxes.length; i++) {
	                if (checkboxes[i].type == 'checkbox' && !(checkboxes[i].disabled)) {
	                    checkboxes[i].checked = true;
	                }
	            }
	        } else {
	            for (var i = 0; i < checkboxes.length; i++) {
	                if (checkboxes[i].type == 'checkbox') {
	                    checkboxes[i].checked = false;
	                }
	            }
	        }
	    }

	    const logo = document.getElementById('logo')
	    $(logo).change(evt => {
	        const [file] = logo.files
	        if (file) {
	            lg.src = URL.createObjectURL(file)
	        }
	    })

	    const wallpaper = document.getElementById('wallpaper')
	    $(wallpaper).change(evt => {
	        const [file] = wallpaper.files
	        if (file) {
	            wllppr.src = URL.createObjectURL(file)
	        }
	    })

	    const gambar = document.getElementById('gambar')
	    $(gambar).change(evt => {
	        const [file] = gambar.files
	        if (file) {
	            gmbr.src = URL.createObjectURL(file)
	        }
	    })


	    const flashDataError = $('.flash-data-error').data('flashdataerror')
	    if (flashDataError) {
	        swal({
	            title: "Gagal!",
	            text: flashDataError,
	            icon: "error",
	        });
	    }

	    const flashDataSuccess = $('.flash-data-success').data('flashdatasuccess')
	    if (flashDataSuccess) {
	        swal({
	            title: "Berhasil!",
	            text: flashDataSuccess,
	            icon: "success",
	        });
	    }

	    const flashDataWarning = $('.flash-data-warning').data('flashdatawarning')
	    if (flashDataWarning) {
	        swal({
	            title: "Peringatan!",
	            text: flashDataWarning,
	            icon: "warning",
	        });
	    }


	    $('#data-table-default').DataTable({
	        responsive: true,
	        dom: '<"row"<"col-sm-5"B><"col-sm-7"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>',
	        buttons: [{
	                extend: 'copy',
	                className: 'btn-sm'
	            },
	            {
	                extend: 'csv',
	                className: 'btn-sm'
	            },
	            {
	                extend: 'excel',
	                className: 'btn-sm'
	            },
	            {
	                extend: 'pdf',
	                className: 'btn-sm'
	            },
	            {
	                extend: 'print',
	                className: 'btn-sm'
	            }
	        ],
	    });

	    $('#data-table').DataTable({
	        dom: '<"row"<"col-sm-5"B><"col-sm-7"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>',
	        buttons: [{
	                extend: 'copy',
	                className: 'btn-sm'
	            },
	            {
	                extend: 'csv',
	                className: 'btn-sm'
	            },
	            {
	                extend: 'excel',
	                className: 'btn-sm'
	            },
	            {
	                extend: 'pdf',
	                className: 'btn-sm'
	            },
	            {
	                extend: 'print',
	                className: 'btn-sm'
	            }
	        ],
	    });

	    $('#datatable-report').DataTable({
	        dom: '<"row"<"col-sm-5"B><"col-sm-7"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>',
	        buttons: [{
	            extend: 'excel',
	            className: 'btn-sm',
	            text: ' <i class="fa fa-print" ></i> Print'
	        }],
	    });
	</script>

	<!-- ================== END page-js ================== -->
	</body>

	</html>