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
                            <a href="<?= base_url('dashboard/positions/create') ?>" class="btn btn-primary float-right fas fa-plus"></a>
                        </div>
                    </div>
                    <div class="flash-data-success" data-flashdatasuccess="<?= $this->session->flashdata('success') ?>">
                    </div>
                    <div class="flash-data-error" data-flashdataerror="<?= $this->session->flashdata('error') ?>"></div>

                    <div class="panel-body" class="table-responsive">
                        <table style="width: 100%;" id="data-table-default" class="table table-striped table-bordered align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>jabatan</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0;
                                foreach ($positions as $position) : ?>
                                    <tr>
                                        <td><?= ++$no; ?></td>
                                        <td><?= $position['jabatan'] ?></td>
                                        <td>
                                            <a class="fas fa-location-arrow btn btn-sm bg-primary text-white" href="<?= base_url('dashboard/positions/employees/' . $position['id_position']) ?>"></a>
                                            <a class="fa fa-edit btn btn-sm bg-warning text-white" href="<?= base_url('dashboard/positions/edit/' . $position['id_position']) ?>"></a>

                                            <a id="delete-button" class="fas fa-trash btn btn-sm bg-danger text-white" href="<?= base_url('positions/delete/' . $position['id_position']) ?>"></a>
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