<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                </nav>
            </div>
        </div>
    </div>
    <!-- // Basic multiple Column Form section start -->
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">

                    <a href="<?= base_url('home/user') ?>" class="d-flex justify-content-end">
    <button class="btn btn-danger">Back</button>
</a>
                        <h4 class="card-title">Edit</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="<?= base_url('home/aksi_edit_user') ?>" method="POST" enctype="multipart/form-data">
                                <div class="row">
                    

                            <div class="col-md-12 col-12">
                                <label>Level</label>
                            <div class="form-group">
                            <select class="form-select" id="editlevel" name="level" required>

    <option value="">Pilih</option>
    <option value="1" <?= isset($elly->level) && $elly->level == 1 ? 'selected' : '' ?>>Admin</option>
    <option value="2" <?= isset($elly->level) && $elly->level == 2 ? 'selected' : '' ?>>Masyarakat</option>
</select>

                            </div>

                            </div>


                            <div class="col-md-12 col-12">
                                <label>Username</label>
                            <div class="form-group">
                                <input type="text" id="editusn" class="form-control" name="usn" placeholder="Username" value="<?= $elly->nama_user ?? '' ?>" required>
                            </div>
                            </div>

                            <div class="col-md-12 col-12">
                                <label>Nama Lengkap</label>
                            <div class="form-group">
                                <input type="text" id="editNama" class="form-control" name="nama" placeholder="Nama Lengkap" value="<?= $elly->nama_lengkap ?? '' ?>" required>
                            </div>
                            </div>
                       
                
                                    <!-- Button Submit dan Reset -->
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                        <input type="hidden" name="id" value="<?= $elly->id_user ?? '' ?>">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- // Basic multiple Column Form section end -->
</div>


</body>

  