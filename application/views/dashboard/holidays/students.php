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

                    <div class="panel-body" class="table-responsive">
                        <form action="<?= base_url('positions/employee_update') ?>" method="post">
                            <div class="input-group mb-3">
                                <select name="class" class="form-select flex-grow-1">
                                    <option selected disabled>-- Pilih jabatan --</option>
                                    <?php foreach ($positions as $jabatan) : ?>
                                        <option <?= ($position['jabatan'] == $jabatan['jabatan'] ? "selected" : "") ?> value="<?= $jabatan['id_position'] ?>"><?= $jabatan['jabatan'] ?></option>
                                    <?php endforeach ?>
                                </select>
                                <input type="hidden" name="id_position" value="<?= $position['id_position'] ?>">
                                <button class="btn btn-secondary" type="submit">Go!</button>
                            </div>

                            <table style="width: 100%;" id="data-table-default" class="table table-striped table-bordered align-middle">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" onchange="checkAll(this)" name="chk[]">
                                        </th>
                                        <th>#</th>
                                        <th>ID Card</th>
                                        <th>Nama</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0;
                                    foreach ($employees as $employee) : ?>
                                        <tr>
                                            <td><input type="checkbox" name="chkbox[]" value="<?= $employee['id_employee'] ?>">
                                            </td>
                                            <td><?= ++$no; ?></td>
                                            <td><?= $employee['id_card'] ?></td>
                                            <td><?= $employee['nama'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </form>
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