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
                            <div class="card-header d-flex justify-content-between">
                                <h5 class="card-title mb-0"><?= $title ?></h5>
                                <a href="<?= base_url('employee_parking_transactions/invoice/' . $employee_parking_transactions['id_employee_parking_transaction']) ?>" class="btn btn-primary"> <i class="fa fa-print"></i> Print</a>
                            </div>
                            <div class="flash-data-success" data-flashdatasuccess="<?= $this->session->flashdata('success') ?>"></div>


                            <div class="card-body">
                                <div class="img-preview d-flex">
                                    <img src="<?= base_url('assets/img/uploads/' . $employee_parking_transactions['employee_foto']) ?>" id="gmbr" class="img-fluid img-thumbnail mx-auto d-block text-center" style="height:100px; width:100px" alt="">
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-3">Nama</div>
                                    <div class="col"><?= $employee_parking_transactions['employee_nama'] ?></div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-3">ID Card</div>
                                    <div class="col"><?= $employee_parking_transactions['employee_nis'] ?></div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-3">Harga</div>
                                    <div class="col"><?= "Rp " . number_format($employee_parking_transactions['harga'], 0, ',', '.')  ?></div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-3">Saldo</div>
                                    <div class="col"><?= "Rp " . number_format($employee_parking_transactions['saldo_awal'], 0, ',', '.')  ?></div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-3">Sisa Saldo</div>
                                    <div class="col"><?= "Rp " . number_format($employee_parking_transactions['saldo_akhir'], 0, ',', '.')   ?></div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-3">Time</div>
                                    <div class="col"><?= $employee_parking_transactions['created_at'] ?></div>
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