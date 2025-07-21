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
