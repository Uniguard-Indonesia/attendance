<?php $this->load->view('layout/head') ?>

<div class="wrapper">
    <?php $this->load->view('layout/sidebar') ?>
    <div class="main">
        <?php $this->load->view('layout/header') ?>

        <main class="content">
            <div class="tab " style="background-color:aliceblue;">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#icon-tab-1" data-bs-toggle="tab" role="tab">
                            <i class="align-middle fas fa-user-circle"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#icon-tab-2" data-bs-toggle="tab" role="tab">
                            <i class="align-middle fas fa-key"></i>
                        </a>
                    </li>

                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="icon-tab-1" role="tabpanel">
                        <h4 class="tab-title">Profile</h4>
                        <?= $this->session->flashdata('message'); ?>
                        <div class="flash-data-success" data-flashdatasuccess="<?= $this->session->flashdata('success') ?>"></div>

                        <?php echo form_open_multipart('auth/user_profile_update'); ?>
                        <input type="hidden" class="form-control" name="id_user" value="<?= $user['id_user'] ?>">

                        <div class="img-preview d-flex">
                            <img src="<?= base_url('assets/img/uploads/' . $user['foto']) ?>" id="gmbr" class="img-fluid img-thumbnail mx-auto d-block text-center" style="height:100px; width:100px" alt="">
                        </div>
                        <div class="form-group">
                            <label for="gambar">Gambar</label>
                            <input type="file" id="gambar" class="form-control" size="20" name="foto" id="gambar" aria-describedby="gambar" placeholder="Masukan gambar">
                            <span class="text-danger">
                                <?= form_error('gambar') ?>
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input autocomplete="off" type="text" class="form-control" name="nama" value="<?= $user['nama'] ?>" id="nama" aria-describedby="nama" placeholder="Masukan Nama">
                            <span class="text-danger">
                                <?= form_error('nama') ?>
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input autocomplete="off" type="text" class="form-control" value="<?= $user['username'] ?>" name="username" id="username" aria-describedby="username" placeholder="Masukan Username">
                            <span class="text-danger">
                                <?= form_error('username') ?>
                            </span>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <?= form_close() ?>
                    </div>
                    <div class="tab-pane" id="icon-tab-2" role="tabpanel">
                        <h4 class="tab-title">Password</h4>
                        <?= $this->session->flashdata('message'); ?>
                        <div class="flash-data-success" data-flashdatasuccess="<?= $this->session->flashdata('success') ?>"></div>

                        <form action="<?= base_url('auth/user_password') ?>" method="post">
                            <input type="hidden" class="form-control" name="id_user" value="<?= $user['id_user'] ?>">

                            <div class="form-group">
                                <label for="current_password">Password saat ini</label>
                                <input type="text" autocomplete="off" class="form-control" name="current_password" id="current_password" aria-describedby="current_password" placeholder="Password Saat Ini" required>
                                <span class="text-danger">
                                    <?= form_error('current_password') ?>
                                </span>
                            </div>

                            <div class="form-group">
                                <label for="new_password">Password baru</label>
                                <input type="text" autocomplete="off" class="form-control" name="new_password" id="new_password" aria-describedby="new_password" placeholder="Password Baru" required>
                                <span class="text-danger">
                                    <?= form_error('new_password') ?>
                                </span>
                            </div>

                            <div class="form-group">
                                <label for="confirm_password">Password konfirmasi</label>
                                <input type="text" autocomplete="off" class="form-control" name="confirm_password" id="confirm_password" aria-describedby="confirm_password" placeholder="Password Konfirmasi" required>
                                <span class="text-danger">
                                    <?= form_error('confirm_password') ?>
                                </span>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </main>
        <?php $this->load->view('layout/footer') ?>
    </div>
</div>
<?php $this->load->view('layout/foot') ?>