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
                        <?php echo form_open_multipart('settings/update'); ?>

                        <fieldset>
                            <div class="container">
                              
                                <div class="row">
                                    <div class="text-center">
                                        <h5>Karyawan</h5>
                                    </div>
                                    <div class="col-5">
                                        <label for="employee_masuk">Masuk</label>
                                        <div class="input-group">
                                            <input type="time" name="waktu_employee_masuk1" value="<?= explode('-', $operational_time[0]['waktu_masuk'])[0] ?>" class="form-control" id="employee_masuk">
                                            <input type="time" name="waktu_employee_masuk2" value="<?= explode('-', $operational_time[0]['waktu_masuk'])[1] ?>" class="form-control" id="employee_masuk">
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <label for="employee_keluar">Keluar</label>
                                        <div class="input-group">
                                            <input type="time" name="waktu_employee_keluar1" value="<?= explode('-', $operational_time[0]['waktu_keluar'])[0] ?>" class="form-control" id="employee_keluar">
                                            <input type="time" name="waktu_employee_keluar2" value="<?= explode('-', $operational_time[0]['waktu_keluar'])[1] ?>" class="form-control" id="employee_keluar">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <label for="employee_telat">Telat</label>
                                        <input type="time" name="telat_employee" value="<?= $operational_time[0]['telat'] ?>" class="form-control" id="employee_telat">
                                    </div>
                                </div>


                                <div class="row mt-5">
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" <?= ($settings_weekend_attendance['value'] ==  'on') ? 'checked' : '' ?> name="weekend_attendance" type="checkbox" role="switch" id="weekend_attendance">
                                            <label class="form-check-label" for="weekend_attendance">Weekend Attendance</label>
                                        </div>

                                    </div>
                                    <div class="mb-3">
                                        <label for="school_name" class="form-label">School Name</label>
                                        <input type="text" name="school_name" value="<?= $settings_school_name['value'] ?>" class="form-control" id="school_name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="school_address" class="form-label">School Address</label>

                                        <textarea name="school_address" class="form-control" rows="3"><?= $settings_school_address['value'] ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="secret_key" class="form-label">Secret Key</label>
                                        <input type="text" name="secret_key" value="<?= $settings_secret_key['value'] ?>" class="form-control" id="secret_key">
                                    </div>
                                    <?php
                                    $url = $settings_wabot['value'];

                                    function is_valid_url($url)
                                    {
                                        return filter_var($url, FILTER_VALIDATE_URL) !== false;
                                    }

                                    function is_website_available($url)
                                    {
                                        $ch = curl_init($url);
                                        curl_setopt($ch, CURLOPT_NOBODY, true);
                                        curl_exec($ch);
                                        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                                        curl_close($ch);
                                        return $http_code == 200;
                                    }

                                    if (is_valid_url($url)) : ?>
                                        <?php if (is_website_available($url)) : ?>
                                            <div class="mb-3">
                                                <label for="message" class="form-label">Message Whatsapp</label>

                                                <div class="alert alert-info" role="alert">
                                                    <h4 class="alert-heading">Keyword Whatsapp Notification</h4>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <h5>$nama</h5>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <h5>$jabatan</h5>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <h5>$keterangan</h5>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <h5>$jabatan</h5>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <h5>$waktu</h5>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <h5>$tanggal</h5>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <h5>$hari</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h5>karyawan</h5>
                                                <textarea name="message_employee" class="form-control" id="message_employee" rows="3"><?= $settings_message_employee['value'] ?></textarea>
                                            </div>

                                        <?php endif ?>
                                    <?php endif ?>

                                    <hr>
                                    <div class="mb-3">
                                        <div class="img-preview d-flex">
                                            <img src="<?= base_url('/assets/img/uploads/' . $settings_logo['value']) ?>" id="lg" class="img-fluid img-thumbnail mx-auto d-block text-center" style="height:100px;width:100px;" alt="">
                                        </div>
                                        <label for="logo" class="form-label">Logo</label>
                                        <input type="file" class="form-control" name="logo" id="logo">
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <div class="img-preview d-flex">
                                            <img src="<?= base_url('/assets/img/uploads/' . $settings_wallpaper['value']) ?>" id="wllppr" class="img-fluid img-thumbnail mx-auto d-block text-center" style="height:200px;" alt="">
                                        </div>
                                        <label for="wallpaper" class="form-label">Wallpaper</label>
                                        <input type="file" class="form-control" name="wallpaper" id="wallpaper">
                                    </div>
                                </div>
                                <div class="d-flex h-100 mt-3">
                                    <div class="align-self-center mx-auto">
                                        <button type="submit" class="btn btn-primary">Update Setting</button>
                                    </div>
                                </div>
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