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
                            <a href="<?= base_url('dashboard/employees/create') ?>" class="btn btn-primary float-right fas fa-plus"></a>
                        </div>
                    </div>
                    <div class="modal fade" id="defaultModalPrimary" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Import karyawan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                <div class="modal-body m-3">
                                    <form action="<?= base_url('employees/upload') ?>" enctype="multipart/form-data" method="post">
                                        <div class="input-group mb-3">
                                            <input class="form-control" type="file" id="file-import-karyawan" name="fileURL">
                                            <button type="submit" class="btn btn-primary">Import</button>

                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <a href="<?= base_url('employees/template') ?>">Download Template</a>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flash-data-success" data-flashdatasuccess="<?= $this->session->flashdata('success') ?>"></div>
                    <div class="flash-data-error" data-flashdataerror="<?= $this->session->flashdata('error') ?>"></div>

                    <div class="panel-body table-responsive">
                        <?php if (form_error('fileURL')) { ?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <?php print form_error('fileURL'); ?>
                            </div>
                        <?php } ?>
                        <form action="<?= base_url('employees/export_images') ?>" method="post">
                            <div class="btn-group mb-3 btn-group-sm">
                                <select class="form-control" name="id_device">
                                    <?php foreach ($devices as $key => $device) : ?>
                                        <option value="<?= $device['id_device'] ?>"><?= $device['nama'] ?></option>
                                    <?php endforeach ?>
                                </select>
                                <button class="btn btn-primary">upload</button>
                            </div>
                        </form>
                        <div class="btn-group mb-3 btn-group-sm">
                            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#defaultModalPrimary">Import</a>
                            <a href="<?= base_url('employees/export_excel') ?>" type="button" class="btn btn-success">Export</a>
                        </div>
                        <table style="width: 100%;" id="data-table" class="table table-striped table-bordered align-middle">
                            <thead>
                                <tr>
                                    <th width="10%">#</th>
                                    <th>Foto</th>
                                    <th>Nama</th>
                                    <th>ID Card</th>
                                    <th>jabatan</th>
                                    <th>Gender</th>
                                    <th>TTL</th>
                                    <th>No HP</th>
                                    <th>No HP Ortu</th>
                                    <th>Alamat</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0;
                                foreach ($employees as $employee) : ?>
                                    <tr>
                                        <td><?= ++$no; ?></td>
                                        <td>
                                            <img src="<?= base_url('/assets/img/uploads/' . $employee['foto']) ?>" class="img-fluid img-thumbnail mx-auto d-block text-center overflow-hidden" style="height:100px; width:100px" alt="">
                                        </td>
                                        <td><?= $employee['nama'] ?></td>
                                        <td><?= $employee['id_card'] ?></td>
                                        <td><?= $employee['jabatan']  ?></td>
                                        <td><?= $employee['jenis_kelamin'] ?></td>
                                        <td><?= $employee['tempat_lahir'] ?>, <?= $employee['tanggal_lahir'] ?></td>
                                        <td><?= $employee['no_hp'] ?></td>
                                        <td>0<?= $employee['no_hp_ortu'] ?></td>
                                        <td><?= $employee['alamat'] ?></td>
                                        <td>
                                            <a class="fa btn-sm fa-edit btn bg-warning text-white" href="<?= base_url('dashboard/employees/edit/' . $employee['id_employee']) ?>"></a>
                                            <a class="fas fa-eye btn-sm btn bg-info text-white" href="<?= base_url('dashboard/employees/' . $employee['id_employee']) ?>"></a>
                                            <a id="delete-button" class="fas btn-sm fa-trash btn bg-danger text-white" href="<?= base_url('employees/delete/' . $employee['id_employee']) ?>"></a>
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