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
        <div class="row">
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
                    <div class="panel-body">
                        <form action="<?= base_url('employee_attandances/update') ?>" method="post">
                            <dl>
                                <dt>Nama</dt>
                                <dd><?= $employee_attandance['nama'] ?></dd>

                                <dt>jabatan</dt>
                                <dd><?= $employee_attandance['jabatan'] ?></dd>

                                <dt>Tanggal</dt>
                                <dd><?= date("Y-m-d", strtotime($employee_attandance['created_at']))  ?></dd>
                            </dl>
                            <?= $this->session->flashdata('message'); ?>
                            <fieldset>
                                <input type="hidden" class="form-control" name="id_employee_attandance" value="<?= $employee_attandance['id_employee_attandance'] ?>">
                                <input type="hidden" class="form-control" name="is_updated" value="<?= $employee_attandance['is_updated'] ?>">
                                <div class="form-group">
                                    <label for="masuk">Masuk</label>
                                    <select name="masuk" class="form-control">
                                        <option value="1" <?= ($employee_attandance['masuk'] == 1) ? 'selected' : '' ?>>Ya</option>
                                        <option value="0" <?= ($employee_attandance['masuk'] == 0) ? 'selected' : '' ?>>Tidak</option>
                                    </select>
                                    <span class="text-danger">
                                        <?= form_error('masuk') ?>
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label for="keluar">keluar</label>
                                    <select name="keluar" class="form-control">
                                        <option value="1" <?= ($employee_attandance['keluar'] == 1) ? 'selected' : '' ?>>Ya</option>
                                        <option value="0" <?= ($employee_attandance['keluar'] == 0) ? 'selected' : '' ?>>Tidak</option>
                                    </select>
                                    <span class="text-danger">
                                        <?= form_error('keluar') ?>
                                    </span>
                                </div>

                                <div class="form-group">
                                    <label for="status_hadir">status_hadir</label>
                                    <select name="status_hadir" class="form-control">
                                        <option value="Hadir" <?= ($employee_attandance['status_hadir'] == 'Hadir') ? 'selected' : '' ?>>Hadir</option>
                                        <option value="Sakit" <?= ($employee_attandance['status_hadir'] == 'Sakit') ? 'selected' : '' ?>>Sakit</option>
                                        <option value="Alfa" <?= ($employee_attandance['status_hadir'] == 'Alfa') ? 'selected' : '' ?>>Alfa</option>
                                    </select>
                                    <span class="text-danger">
                                        <?= form_error('status_hadir') ?>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="ket">Keterangan</label>
                                    <input autocomplete="off" type="text" value="<?= $employee_attandance['ket'] ?>" class="form-control" name="ket" placeholder="keluaran Keterangan">

                                    <span class="text-danger">
                                        <?= form_error('ket') ?>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </fieldset>
                        </form>

                    </div>
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