<div class="main-content container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class='breadcrumb-header'>
                </nav>
            </div>
        </div>
    </div>

    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" align="center">RESTORE</h4>
                </div>
                <div class="card-content">
                    <!-- table bordered -->
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
                                foreach($elly as $gou){
                                    if ($gou->isdelete == 1) {  
                                ?>
                                    <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $gou->task ?></td>
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
                                        <?php 
                                        switch($gou->status){
                                            case 0: echo "Belum Selesai"; break;
                                            case 1: echo "Selesai"; break;
                                        }
                                        ?>
                                    </td>
                                        <td>
                                        <a href="<?= base_url('home/aksi_restore_task/'.$gou->id_task)?>">        
    <button class="btn btn-danger btn-sm ">Restore</button>
    </a>
                                        </td>
                                    </tr>
                                <?php
                                    
                                }}
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> <!-- end of .card -->
        </div> <!-- end of .col-12 -->
    </div> <!-- end of .row -->
</div> <!-- end of .main-content container-fluid -->



