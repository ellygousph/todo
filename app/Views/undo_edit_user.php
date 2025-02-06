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
                        <h4 class="card-title">Undo Edit</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form action="<?= base_url('home/aksi_unedit_user') ?>" method="POST" enctype="multipart/form-data">
                                <div class="row">
                    

                                <div class="col-md-12 col-12">
    <label>Level</label>
    <div class="form-group">
        <select class="form-select disabled-field" id="undolevel" name="level" onchange="toggleUndoKelas()">
            <option value="">Pilih</option>
            <option value="1" <?= isset($backup_user[$elly->id_user]) && $backup_user[$elly->id_user]->level == 1 || (isset($elly->level) && $elly->level == 1) ? 'selected' : '' ?>>Admin</option>
            <option value="2" <?= isset($backup_user[$elly->id_user]) && $backup_user[$elly->id_user]->level == 2 || (isset($elly->level) && $elly->level == 2) ? 'selected' : '' ?>>Masyarakat</option>
           
        </select>
    </div>
</div>


                            <div class="col-md-12 col-12">
                                <label>Username</label>
                            <div class="form-group">
                                <input type="text" id="undousn" class="form-control disabled-field" name="usn" placeholder="Username" value="<?= isset($backup_user[$elly->id_user]) ? $backup_user[$elly->id_user]->nama_user : $elly->nama_user ?? '' ?>">
                            </div>
                            </div>
                         
                            <div class="col-md-12 col-12">
                                <label>Nama Lengkap</label>
                            <div class="form-group">
                                <input type="text" id="undoNama" class="form-control disabled-field" name="nama" placeholder="Nama Lengkap" value="<?= isset($backup_user[$elly->id_user]) ? $backup_user[$elly->id_user]->nama_lengkap : $elly->nama_lengkap ?? '' ?>">
                            </div>
                            </div>
                            
                                    <!-- Button Submit dan Reset -->
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Undo</button>
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        toggleUndoKelas(); // Panggil fungsi toggleEditKelas saat halaman selesai dimuat

       
    });

    function toggleUndoKelas() {
    var level = document.getElementById('undolevel').value;
    var kelasField = document.getElementById('undoKelas');
    var nisField = document.getElementById('undoNis');
    var nisnField = document.getElementById('undoNisn');
    var nuptkField = document.getElementById('undoNuptk');
    var nikField = document.getElementById('undoNik');
    
    var kelasLabel = document.getElementById('undoKelasLabel');
    var nisLabel = document.getElementById('undoNisLabel');
    var nisnLabel = document.getElementById('undoNisnLabel');
    var nuptkLabel = document.getElementById('undoNuptkLabel');
    var nikLabel = document.getElementById('undoNikLabel');

    

    // Menampilkan kelas hanya untuk level 6 dan 7
    if (level == 6 || level == 7) {
        kelasField.style.display = 'block';
        kelasLabel.style.display = 'block';
    } else {
        kelasField.style.display = 'none';
        kelasLabel.style.display = 'none';
    }

    // Menampilkan NIK hanya untuk level 1
    if (level == 1) {
        nikField.style.display = 'block';
        nikLabel.style.display = 'block';
    } else {
        nikField.style.display = 'none';
        nikLabel.style.display = 'none';
    }

    // Menampilkan NIK dan NUPTK untuk level 2, 3, 4, 5
    if (level == 2 || level == 3 || level == 4 || level == 5) {
        nikField.style.display = 'block';
        nikLabel.style.display = 'block';
        nuptkField.style.display = 'block';
        nuptkLabel.style.display = 'block';
    } else {
        nuptkField.style.display = 'none';
        nuptkLabel.style.display = 'none';
    }

    // Menampilkan NIS dan NISN hanya untuk level 6
    if (level == 6) {
        nisField.style.display = 'block';
        nisLabel.style.display = 'block';
        nisnField.style.display = 'block';
        nisnLabel.style.display = 'block';
    } else {
        nisField.style.display = 'none';
        nisLabel.style.display = 'none';
        nisnField.style.display = 'none';
        nisnLabel.style.display = 'none';
    }
}
</script>

<style>
    .disabled-field {
        pointer-events: none;
        background-color: #e9ecef; /* Optional: change the background color to indicate it's disabled */
    }
</style>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>


