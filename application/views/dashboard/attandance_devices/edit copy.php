<?php $this->load->view('layout/head') ?>

<div class="wrapper">
    <?php $this->load->view('layout/sidebar') ?>
    <div class="main">
        <?php $this->load->view('layout/header') ?>

        <main class="content">
            <div class="container-fluid p-0">
                <div class="row removable">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0"><?= $title ?></h5>
                            </div>
                            <div class="card-body">
                                <?= $this->session->flashdata('message'); ?>

                                <?php echo form_open_multipart('attandance_devices/update'); ?>
                                <input type="hidden" class="form-control" name="id_attandance_device" value="<?= $device['id_attandance_device'] ?>">

                                <div class="img-preview d-flex">
                                    <img src="<?= base_url('/assets/img/uploads/' . $device['gambar']) ?>" id="gmbr" class="img-fluid img-thumbnail mx-auto d-block text-center" style="height:200px; width:200px;" alt="">
                                </div>
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
                                <?= form_close() ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <?php $this->load->view('layout/footer') ?>
    </div>
</div>

<?php $this->load->view('layout/foot') ?>