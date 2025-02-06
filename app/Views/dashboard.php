<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow-lg border-0">
                    <div class="card-body text-center p-5">
                        <h5 class="card-title text-uppercase fw-bold text-primary mb-4">Tugas Selesai</h5>
                        <?php
                            // Menghitung jumlah task yang selesai
                            $task_completed = 0;
                            foreach ($elly as $task) {
                                if ($task->status == 1) { // Ganti dengan -> untuk mengakses properti objek
                                    $task_completed++;
                                }
                            }
                        ?>
                        <p class="display-4 fw-bold text-success"><?= $task_completed ?></p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-lg border-0">
                    <div class="card-body text-center p-5">
                        <h5 class="card-title text-uppercase fw-bold text-primary mb-4">Tugas Belum Selesai</h5>
                        <?php
                            // Menghitung jumlah task yang belum selesai
                            $task_pending = 0;
                            foreach ($elly as $task) {
                                if ($task->status == 0) { // Ganti dengan -> untuk mengakses properti objek
                                    $task_pending++;
                                }
                            }
                        ?>
                        <p class="display-4 fw-bold text-danger"><?= $task_pending ?></p>
                    </div>
                </div>
            </div>

            <!-- Card untuk informasi lainnya atau data tambahan bisa ditambahkan di sini -->
        </div>
    </section>
</main>

<!-- Custom CSS -->
<style>
    .card {
        background: linear-gradient(135deg, #e9f1f7, #ffffff);
        border-radius: 20px;
        transition: transform 0.3s ease-in-out;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .card-title {
        letter-spacing: 1px;
    }

    .card-body {
        animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
