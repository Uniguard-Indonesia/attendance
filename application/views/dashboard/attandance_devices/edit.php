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
                        <?php echo form_open_multipart('attandance_devices/update'); ?>
                        <input type="hidden" class="form-control" name="id_attandance_device" value="<?= $device['id_attandance_device'] ?>">

                        <div class="img-preview d-flex">
                            <img src="<?= base_url('/assets/img/uploads/' . $device['gambar']) ?>" id="gmbr" class="img-fluid img-thumbnail mx-auto d-block text-center" style="height:200px; width:200px;" alt="">
                        </div>
                        <fieldset>
                            <div class="form-group">
                                <label for="gambar">Gambar</label>
                                <input type="file" id="gambar" class="form-control" size="20" name="gambar" id="gambar" aria-describedby="gambar" placeholder="Masukan gambar">
                                <span class="text-danger">
                                    <?= form_error('gambar') ?>
                                </span>
                            </div>

                            <div class="form-group">
                                <label for="device">ID Device</label>
                                <input autocomplete="off" type="number" class="form-control" value="<?= $device['device'] ?>" name="device" id="device" aria-describedby="device" placeholder="Masukan Username">
                                <span class="text-danger">
                                    <?= form_error('device') ?>
                                </span>
                            </div>

                            <div class="form-group">
                                <label for="lokasi">Lokasi</label>
                                <input autocomplete="off" type="text" value="<?= $device['lokasi'] ?>" class="form-control" name="lokasi" id="lokasi" aria-describedby="lokasi" placeholder="Masukan Lokasi">
                                <span class="text-danger">
                                    <?= form_error('lokasi') ?>
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