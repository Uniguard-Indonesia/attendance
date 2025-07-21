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
                    <form action="<?= base_url('') ?>" method="get" class="input-group m-3 input-group-sm">
                        <div class="input-group w-50 d-flex justify-content center">
                            <input type="date" value="<?= $this->input->get('startDate') ?>" name="startDate" class="form-control">
                            <input type="date" value="<?= $this->input->get('endDate') ?>" name="endDate" class="form-control">
                            <button class="btn btn-secondary" type="submit">Filter</button>
                        </div>
                    </form>


                    <div class="panel-body table-responsive">
                        <table style="width: 100%;" id="datatable-report" class="table table-striped table-bordered align-middle">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <!--<th>jabatan</th>-->
                                    <?php foreach ($dates as $date) : ?>
                                        <th><?= date("d M Y", strtotime($date)) ?></th>
                                    <?php endforeach ?>
                                    <th>Hadir</th>
                                    <th>Alfa</th>
                                    <th>Sakit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($attendance_by_name as $name => $attendance) : ?>
                                    <?php if ($name !== "position") : ?>
                                        <tr>
                                            <td> <?= $attendance_by_name[$name]["real_name"] ?> </td>
                                            <!--<td> <?= $attendance_by_name[$name]["position"] ?> </td>-->
                                            <?php
                                            $jumlah_hadir = 0;
                                            $jumlah_alfa = 0;
                                            $jumlah_sakit = 0;
                                            ?>
                                            <?php foreach ($dates as $date) : ?>
                                                <?php
                                                $status = isset($attendance_by_name[$name][$date]["status"]) ? $attendance_by_name[$name][$date]["status"] : "-";
                                                $ket = isset($attendance_by_name[$name][$date]["ket"]) ? $attendance_by_name[$name][$date]["ket"] : "-";
                                                ?>
                                                <td> <?= $status ?> </td>
                                                <?php
                                                if ($status == "Hadir") {
                                                    $jumlah_hadir++;
                                                } else if ($status == "Alfa") {
                                                    $jumlah_alfa++;
                                                } else if ($status == "Sakit") {
                                                    $jumlah_sakit++;
                                                }
                                                ?>
                                            <?php endforeach ?>
                                            <td> <?= $jumlah_hadir ?> </td>
                                            <td> <?= $jumlah_alfa ?> </td>
                                            <td> <?= $jumlah_sakit ?> </td>
                                        </tr>
                                    <?php endif ?>
                                <?php endforeach ?>
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