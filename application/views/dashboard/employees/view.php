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


                    <div class="panel-body">

                        <img src="<?= base_url('/assets/img/uploads/' . $employee['foto']) ?>" id="gmbr" class="img-fluid img-thumbnail mx-auto d-block text-center" style="height:200px;width:200px;" alt="">
                        <dl>
                            <dt>Nama</dt>
                            <dt><?= $employee['nama'] ?></dt>
                        </dl>
                        <dl>
                            <dt>ID Card</dt>
                            <dt><?= $employee['id_card'] ?></dt>
                        </dl>
                        <dl>
                            <dt>jabatan</dt>
                            <dt><?= $employee['jabatan'] ?></dt>
                        </dl>
                        <dl>
                            <dt>TTL</dt>
                            <dt><?= $employee['tempat_lahir'] ?>, <?= $employee['tanggal_lahir'] ?></dt>
                        </dl>
                        <dl>
                            <dt>Alamat</dt>
                            <dt><?= $employee['alamat'] ?></dt>
                        </dl>
                        <dl>
                            <dt>No HP</dt>
                            <dt><?= $employee['no_hp'] ?></dt>
                        </dl>
                        <dl>
                            <dt>No HP Ortu</dt>
                            <dt><?= $employee['no_hp_ortu'] ?></dt>
                        </dl>
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