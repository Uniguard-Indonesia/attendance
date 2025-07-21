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
                                <div class="team-single">
                                    <div class="row">

                                        <div class="col-lg-12 col-md-8">
                                            <div class="padding-50px-left">

                                                <div class="margin-40px-tb">
                                                    <div class="img-preview d-flex">
                                                        <img src="<?= base_url('/assets/img/uploads/' . $device['gambar']) ?>" id="gmbr" class="img-fluid img-thumbnail mx-auto d-block text-center" style="height:200px;width:200px;" alt="">
                                                    </div>
                                                    <ul class="list-style9 no-margin mt-5">
                                                        <li>
                                                            <div class="row">
                                                                <div class="col-md-5 col-5">
                                                                    <strong class="margin-10px-left text-orange">ID Device</strong>
                                                                </div>
                                                                <div class="col-md-7 col-7">
                                                                    <p><?= $device['device'] ?></p>
                                                                </div>
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="row">
                                                                <div class="col-md-5 col-5">
                                                                    <strong class="margin-10px-left text-orange">Lokasi</strong>
                                                                </div>
                                                                <div class="col-md-7 col-7">
                                                                    <p><?= $device['lokasi'] ?></p>
                                                                </div>
                                                            </div>
                                                        </li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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