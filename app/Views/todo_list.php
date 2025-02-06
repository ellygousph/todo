<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'></nav>
            </div>
        </div>
    </div>
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form action="<?= base_url('home/aksi_tambah_list') ?>" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <label>Nama Task</label>
                                        <div class="form-group">
                                            <input type="text" id="task" class="form-control" name="task" placeholder="Nama Task" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <label>Prioritas</label>
                                        <div class="form-group">
                                            <select class="form-select" id="prio" name="prio" required>
                                                <option value="">Pilih</option>
                                                <option value="1">High</option>
                                                <option value="2">Medium</option>
                                                <option value="3">Low</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12">
                                        <label>Tanggal</label>
                                        <div class="form-group">
                                            <input type="datetime-local" id="tgl" class="form-control" name="tgl" required>
                                        </div>
                                    </div>
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
    
    <!-- Tabel Data Task -->
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">To Do List</h4>
                </div>
                <div class="card-content">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Task</th>
                                    <th>Prioritas</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
    <?php
    $no = 1;
    $belumSelesai = [];
    $selesai = [];

    foreach ($elly as $gou) { 
        if ($gou->isdelete == 0) {
            if ($gou->status == 0) {
                $belumSelesai[] = $gou;
            } else {
                $selesai[] = $gou;
            }
        }
    }

    foreach (array_merge($belumSelesai, $selesai) as $gou) { ?>
        <tr>
            <td><?= $no++ ?></td>
            <td class="<?= $gou->status == 1 ? 'strikethrough' : '' ?>">
                <?= $gou->task ?>
            </td>
            <td>
                <?php 
                switch($gou->priority){
                    case 1: echo "High"; break;
                    case 2: echo "Medium"; break;
                    case 3: echo "Low"; break;
                }
                ?>
            </td>
            <td><?= date('d-m-Y H:i', strtotime($gou->due_date)) ?></td>
            <td>
                <?= $gou->status == 0 ? "Belum Selesai" : "Selesai" ?>
            </td>
            <td>
                <div class="d-flex">
                    <div class="dropdown me-2">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            Aksi
                        </button>
                        <ul class="dropdown-menu">
                            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editUserModal" 
                                data-id="<?= $gou->id_task ?>"  
                                data-task="<?= $gou->task ?>"  
                                data-prio="<?= $gou->priority ?>" 
                                data-tgl="<?= $gou->due_date ?>" 
                            >Edit</button>
                            </li>
                            <li><a class="dropdown-item" href="<?= base_url('home/hapustask/' . $gou->id_task) ?>">Hapus</a></li>
                            <?php if (isset($backup_task[$gou->id_task])) : ?>
                                <li>
                                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#undoEditModal" 
                                        data-id="<?=$backup_task[$gou->id_task]->id_task ?>"  
                                        data-task="<?= $backup_task[$gou->id_task]->task ?>" 
                                        data-prio="<?= $backup_task[$gou->id_task]->priority ?>" 
                                        data-tgl="<?= $backup_task[$gou->id_task]->due_date ?>"
                                    >Undo Edit</button>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>

                    <?php if ($gou->status == 0): ?>
                        <a href="<?= base_url('home/mark_done/' . $gou->id_task) ?>" class="btn btn-success btn-sm">Done</a>
                    <?php elseif ($gou->status == 1): ?>
                        <a href="<?= base_url('home/undo_task/' . $gou->id_task) ?>" class="btn btn-warning btn-sm">Undo</a>
                    <?php endif; ?>
                </div>
            </td>
        </tr>
    <?php } ?>
</tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


 <!-- Edit User Modal -->
 <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editUserForm" action="<?= base_url('home/aksi_edit_task') ?>" method="POST" enctype="multipart/form-data">
                        <div class="row">

                            <div class="col-md-4">
                                <label>Nama Task</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="edittask" class="form-control" name="task" placeholder="Nama Task" required>
                            </div>
                            
                            <div class="col-md-4">
                                <label>Prioritas</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select id="editprio" class="form-control" name="prio" required>
                                    <option value="1">High</option>
                                    <option value="2">Medium</option>
                                    <option value="3">Low</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label>Tanggal</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="datetime-local" id="edittgl" class="form-control" name="tgl" placeholder="Tanggal" required>
                            </div>
            
                            <input type="hidden" id="editId" name="id">

                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Save</button>
                               
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

     <!-- Undo Edit Modal -->
     <div class="modal fade" id="undoEditModal" tabindex="-1" aria-labelledby="undoEditModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="undoEditModalLabel">Undo Edit</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="undoEditForm" action="<?= base_url('home/aksi_unedit_task') ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="undoUserId" name="id">
            <div class="row">
            <div class="col-md-4">
                                <label>Nama Task</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="undotask" class="form-control disabled-field" name="task" placeholder="Nama Task" >
                            </div>
                            
                            <div class="col-md-4">
                                <label>Prioritas</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select id="undoprio" class="form-control disabled-field" name="prio" >
                                    <option value="1">High</option>
                                    <option value="2">Medium</option>
                                    <option value="3">Low</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label>Tanggal</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="datetime-local" id="undotgl" class="form-control disabled-field" name="tgl" placeholder="Tanggal" >
                            </div>

                <div class="col-sm-12 d-flex justify-content-end">
                    
                    <button type="submit" class="btn btn-primary me-1 mb-1">Undo</button>
                </div>
                
            </div>
        </form>
      </div>
    </div>
  </div>
</div>


    <script>
    // Script asli yang sudah ada sebelumnya untuk show.bs.modal
    document.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var task = button.getAttribute('data-task');
        var prio = button.getAttribute('data-prio');
        var tgl = button.getAttribute('data-tgl');

        var modal = document.getElementById('editUserModal');
        modal.querySelector('#editId').value = id;
        modal.querySelector('#edittask').value = task;
        modal.querySelector('#editprio').value = prio;
        modal.querySelector('#edittgl').value = tgl;

        var modal = document.getElementById('undoEditModal');
        modal.querySelector('#undoUserId').value = id;
        modal.querySelector('#undotask').value = task;
        modal.querySelector('#undoprio').value = prio;
        modal.querySelector('#undotgl').value = tgl;

    });


</script>
<style>
    .strikethrough {
    text-decoration: line-through;
}

.disabled-field {
            pointer-events: none;
            background-color: #e9ecef;
        }

    </style>

