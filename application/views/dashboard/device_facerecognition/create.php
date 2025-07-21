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

                    <?= $this->session->flashdata('message'); ?>

                    <div class="panel-body">
                        <?php echo form_open_multipart('device_facerecognition/store'); ?>

                        <?= $this->session->flashdata('message'); ?>
                        <fieldset>

                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input autocomplete="off" type="text" class="form-control" name="nama" id="nama" aria-describedby="nama" placeholder="Masukan Nama" required>
                                <span class="text-danger">
                                    <?= form_error('nama') ?>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="device">ID Device</label>
                                <input autocomplete="off" type="number" class="form-control" name="device" id="device" aria-describedby="device" placeholder="Masukan ID Device" required>
                                <span class="text-danger">
                                    <?= form_error('device') ?>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="ip_address">IP Address</label>
                                <input autocomplete="off" type="text" class="form-control" name="ip_address" id="ip_address" aria-describedby="ip_address" placeholder="Masukan IP Address" required>
                                <span class="text-danger">
                                    <?= form_error('ip_address') ?>
                                </span>
                            </div>


                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </fieldset>
                        <?= form_close() ?>
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