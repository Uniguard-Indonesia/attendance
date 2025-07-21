<?php $this->load->view('layout/head') ?>

<div id="app" class="app app-header-fixed app-sidebar-fixed">
    <!-- END #header -->
    <?php $this->load->view('layout/header') ?>
    <!-- BEGIN #sidebar -->
    <?php $this->load->view('layout/sidebar') ?>

    <div id="content" class="app-content">
        <!-- BEGIN breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:;"><?= $title ?></a></li>
        </ol>
        <!-- END breadcrumb -->
        <!-- BEGIN page-header -->
        <!-- END page-header -->
        <!-- BEGIN row -->
        <div class="row">
            <!-- BEGIN col-2 -->

            <!-- END col-2 -->
            <!-- BEGIN col-10 -->
            <div class="col-xl-12">
                <!-- BEGIN panel -->
                <div class="panel panel-inverse">
                    <!-- BEGIN panel-heading -->
                    <div class="panel-heading">
                        <h4 class="panel-title"><?= $title ?></h4>
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
                        </div>
                    </div>

                    <div class="flash-data-success" data-flashdatasuccess="<?= $this->session->flashdata('success') ?>">
                    </div>
                    <div class="flash-data-error" data-flashdataerror="<?= $this->session->flashdata('error') ?>"></div>
                    <form action="<?= base_url('employee_attandances') ?>" method="get" class="input-group m-3 input-group-sm">
                        <div class="input-group w-50 d-flex justify-content center">
                            <input type="date" value="<?= $this->input->get('startDate') ?>" name="startDate" class="form-control">
                            <input type="date" value="<?= $this->input->get('endDate') ?>" name="endDate" class="form-control">
                            <button class="btn btn-secondary" type="submit"> Filter
                            </button>
                        </div>

                        <a href="employee_attandances/report" class="btn btn-primary">Report</a>

                    </form>


                    <div class="panel-body table-responsive">
                        <table style="width: 100%;" id="data-table-default" class="table table-striped table-bordered align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Masuk</th>
                                    <th>Waktu Masuk</th>
                                    <th>Keluar</th>
                                    <th>Waktu Keluar</th>
                                    <th>Status Hadir</th>
                                    <th>Ket</th>
                                    <th>Tanggal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0;
                                foreach ($attandances as $attandance) : ?>
                                    <tr>
                                        <td><?= ++$no; ?></td>
                                        <td><?= $attandance['name'] ?></td>
                                        <td><?= ($attandance['masuk'] == 1) ? 'Ya' : 'Tidak' ?></td>
                                        <td><?= $attandance['waktu_masuk'] ?></td>
                                        <td><?= ($attandance['keluar'] == 1) ? 'Ya' : 'Tidak' ?></td>
                                        <td><?= $attandance['waktu_keluar'] ?></td>
                                        <td><?= $attandance['status_hadir'] ?></td>
                                        <td><?= $attandance['ket'] ?></td>
                                        <td><?= $attandance['date'] ?></td>
                                        <td>
                                            <!--<a class="fa fa-edit btn btn-sm bg-warning text-white" href="<?= base_url('employee_attandances/edit/' . $attandance['id_employee_attandance']) ?>"></a>-->
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- END hljs-wrapper -->
                </div>
                <!-- END panel -->
            </div>
            <!-- END col-10 -->
        </div>
        <!-- END row -->
    </div>
    <!-- END #content -->

</div>

<?php $this->load->view('layout/foot') ?>