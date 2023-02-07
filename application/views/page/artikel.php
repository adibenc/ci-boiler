<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />

<div class="container mb-5">
    <div class="card border-top border-success border-top-lg h-100">
    <div class="card-header" style='background-image: url("<?= base_url('assets/img/bg.jpg') ?>");'>
            <h1 class="font-weight-bold">Artikel
            </h1>

        </div>
        <div class="card-body">
            <div class="row">
                <?php foreach ($berita as $row) {  ?>
                    <div class="col-md-6 col-xl-4 mb-5">
                        <!-- <a class="card post-preview lift h-100" href="<?= site_url('page/berita/' . encrypt_url($row['id'])) ?>"> -->
                        <a class="card post-preview lift h-100" href="<?= site_url('berita/s/' . $row['slug']) ?>">
                            <div class="card-body">
                                <span class="badge badge-success"><?php echo $row['cat_name']; ?></span>
                                <h5 class="card-title"><?php echo $row['judul']; ?></h5>
                                <p class="card-text"><?php echo substr(strip_tags($row['deskripsi']), 0, 200); ?> ...</p>
                            </div>
                            <div class="card-footer">
                                <div class="post-preview-meta">
                                    <div class="post-preview-meta-details">
                                        <small>Diunggah : <?php echo viewShortDate($row['submit_date']); ?></small>

                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>

            </div>
            <nav aria-label="Page navigation example">
                <?php
                echo $this->pagination->create_links();
                ?>
            </nav>
        </div>
    </div>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="<?php echo base_url() ?>js/scripts-admin.js"></script>