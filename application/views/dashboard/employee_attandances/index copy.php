<?php $this->load->view('layout/head') ?>

<div class="wrapper">
    <?php $this->load->view('layout/sidebar') ?>
    <div class="main">
        <?php $this->load->view('layout/header') ?>

        <main class="content">
            <div class="container-fluid p-0">
                <div class="row removable">
                    <div class="col-lg-12">
                        <div class="card flex-fill">
                            <div class="card-header d-flex justify-content-between">
                                <h5 class="card-title mb-0"><?= $title ?></h5>

                            </div>
                            <div class="card-body">
                                <form action="<?= base_url('attandances/export_excel') ?>" method="get" class="input-group mb-3 input-group-sm">
                                    <div class="input-group w-50 d-flex justify-content center">
                                        <input type="date" name="startDate" class="form-control" placeholder="Search for...">
                                        <input type="date" name="endDate" class="form-control" placeholder="Search for...">
                                        <button class="btn btn-secondary" type="submit"> <i class="fas fa-expott"></i> Export </button>
                                    </div>
                                </form>

                                <div class="table-responsive">
                                    <table id="table" style="width: 100%;" class="table table-hover my-0 ">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>karyawan</th>
                                                <th>Tanggal</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($attandances as $attandance) : ?>
                                                <tr>
                                                    <td><?= ++$no; ?></td>
                                                    <td><?= $attandance['employee_nama'] ?></td>
                                                    <td><?= $attandance['created_at'] ?></td>
                                                    <td>
                                                        <a class="fas fa-eye btn btn-sm bg-primary text-white" href="<?= base_url('dashboard/attandances/view/' . $attandance['id_attandance']) ?>"></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
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