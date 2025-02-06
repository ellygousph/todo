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
                        <h4 class="card-title">Tambah</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="<?= base_url('home/aksi_tambah_user') ?>" method="POST" enctype="multipart/form-data">
                                <div class="row">
                    
                                <div class="col-md-12 col-12">
                                <label>Level</label>
                            <div class="form-group">
                                <select class="form-select" id="level" name="level" required>
                                <option value="">Pilih</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Masyarakat</option>
                                 
                                </select>
                            </div>

                            </div>
                           
                            <div class="col-md-12 col-12">
                                <label>Username</label>
                            <div class="form-group">
                                <input type="text" id="first-name" class="form-control" name="usn" placeholder="Username" required>
                            </div>
                            </div>

                            <div class="col-md-12 col-12">
                                <label>Nama</label>
                            <div class="form-group">
                                <input type="text" id="name" class="form-control" name="nama" placeholder="Nama" required>
                            </div>
                            </div>

                            <div class="col-md-12 col-12">
                                <label>Password</label>
                            
                            <div class="form-group">
                                <input type="password" id="password" class="form-control" name="password" placeholder="Password" required>
                            </div>
                            </div>
                            
                           
                                    <!-- Button Submit dan Reset -->
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                        <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
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

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>

