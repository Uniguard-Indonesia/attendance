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
                        <?php echo form_open_multipart('users/store'); ?>
                        <div class="img-preview d-flex">
                            <img src="<?= 'https://smartschoolintegrated.com/assets/img/default_user.jfif' ?>" id="gmbr" class="img-fluid img-thumbnail mx-auto d-block text-center" style="height:50px" alt="">
                        </div>
                        <?= $this->session->flashdata('message'); ?>
                        <fieldset>

                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="foto">Foto</label>
                                    <input required type="file" id="gambar" class="form-control" size="20" name="foto" id="foto" placeholder="Masukan foto">
                                    <span class="text-danger">
                                        <?= form_error('foto') ?>
                                    </span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input autocomplete="off" type="text" class="form-control" value="<?= set_value('nama') ?>" name="nama" id="nama" aria-describedby="nama" placeholder="Masukan Nama" required>
                                    <span class="text-danger">
                                        <?= form_error('nama') ?>
                                    </span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input autocomplete="off" type="text" class="form-control" value="<?= set_value('username') ?>" name="username" id="username" aria-describedby="username" placeholder="Masukan Username" required>
                                    <span class="text-danger">
                                        <?= form_error('username') ?>
                                    </span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select name="role" class="form-control" id="role" required>
                                        <option selected disabled>-- Pilih Role --</option>
                                        <?php foreach ($roles as $role) : ?>
                                            <option value="<?= $role['id_role'] ?>"><?= $role['role'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <span class="text-danger">
                                        <?= form_error('role') ?>
                                    </span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input autocomplete="off" type="password" class="form-control" required name="password" id="password" aria-describedby="password" placeholder="Masukan Password">
                                    <span class="text-danger">
                                        <?= form_error('password') ?>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary w-100px me-5px">Submit</button>
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