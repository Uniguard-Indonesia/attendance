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
                        <?php echo form_open_multipart('employees/update'); ?>
                        <input type="hidden" class="form-control" name="id_employee" value="<?= $employee['id_employee'] ?>">
                        <div class="img-preview d-flex">
                            <img src="<?= base_url('/assets/img/uploads/' . $employee['foto']) ?>" id="gmbr" class="img-fluid img-thumbnail mx-auto d-block text-center" style="height:200px;width:200px;" alt="">
                        </div>
                        <?= $this->session->flashdata('message'); ?>
                        <fieldset>
                            <div class="form-group">
                                <label for="foto">Foto</label>
                                <input type="file" id="foto" class="form-control" size="20" name="foto" id="foto" aria-describedby="foto" placeholder="Masukan foto">
                                <span class="text-danger">
                                    <?= form_error('foto') ?>
                                </span>
                            </div>

                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input autocomplete="off" type="text" class="form-control" name="nama" value="<?= $employee['nama'] ?>" id="nama" aria-describedby="nama" placeholder="Masukan Nama">
                                <span class="text-danger">
                                    <?= form_error('nama') ?>
                                </span>
                            </div>

                            <div class="form-group">
                                <label for="id_card">ID Card</label>
                                <input autocomplete="off" type="number" class="form-control" value="<?= $employee['id_card'] ?>" name="id_card" id="id_card" aria-describedby="id_card" placeholder="Masukan ID Card" required>
                                <span class="text-danger">
                                    <?= form_error('id_card') ?>
                                </span>
                            </div>

                            <div class="form-group">
                                <label for="tempat_lahir">Tempat Lahir</label>
                                <input autocomplete="off" type="text" class="form-control" value="<?= $employee['tempat_lahir'] ?>" name="tempat_lahir" id="tempat_lahir" aria-describedby="tempat_lahir" placeholder="Masukan Tempat Lahir" required>
                                <span class="text-danger">
                                    <?= form_error('tempat_lahir') ?>
                                </span>
                            </div>

                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <input autocomplete="off" type="date" class="form-control" value="<?= $employee['tanggal_lahir'] ?>" name="tanggal_lahir" id="tanggal_lahir" aria-describedby="tanggal_lahir" placeholder="Masukan Tanggal Lahir" required>
                                <span class="text-danger">
                                    <?= form_error('tanggal_lahir') ?>
                                </span>
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input autocomplete="off" type="text" class="form-control" value="<?= $employee['alamat'] ?>" name="alamat" id="alamat" aria-describedby="alamat" placeholder="Masukan Alamat" required>
                                <span class="text-danger">
                                    <?= form_error('alamat') ?>
                                </span>
                            </div>

                            <div class="form-group">
                                <label for="no_hp">No. HP</label>
                                <input autocomplete="off" type="number" class="form-control" value="<?= $employee['no_hp'] ?>" name="no_hp" id="no_hp" aria-describedby="no_hp" placeholder="Masukan No HP" required>
                                <span class="text-danger">
                                    <?= form_error('no_hp') ?>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="no_hp_ortu">No. HP Ortu</label>

                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">+62</span>
                                    <input type="number" class="form-control" value="<?= $employee['no_hp_ortu'] ?>" name="no_hp_ortu" placeholder="89123456789" aria-label="Username">
                                </div>
                                <span class="text-danger">
                                    <?= form_error('no_hp_ortu') ?>
                                </span>
                            </div>

                            <div class="form-group">
                                <label for="class">jabatan</label>
                                <select name="class" class="form-control" id="class" required>
                                    <option selected disabled>-- Pilih jabatan --</option>
                                    <?php foreach ($positions as $position) : ?>
                                        <option <?= ($employee['id_position'] == $position['id_position'] ? "selected" : "") ?> value="<?= $position['id_position'] ?>"><?= $position['jabatan'] ?></option>
                                    <?php endforeach ?>
                                </select>
                                <span class="text-danger">
                                    <?= form_error('position') ?>
                                </span>
                            </div>

                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control" id="jenis_kelamin" required>
                                    <option selected disabled>-- Pilih Jenis Kelamin --</option>
                                    <option <?= ($employee['jenis_kelamin'] == "Laki-laki" ? "selected" : "") ?> value="Laki-laki">Laki - laki</option>
                                    <option <?= ($employee['jenis_kelamin'] == "Perempuan" ? "selected" : "") ?> value="Perempuan">Perempuan</option>
                                </select>
                                <span class="text-danger">
                                    <?= form_error('jenis_kelamin') ?>
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