<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Event</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
</head>

<body>

    <?= $this->include('header_user_1') ?>

    <div class="container mt-5">

        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h1 class="card-title text-center">Detail Event</h1>
            </div>
            <div class="card-body">
                <h2 class="text-center mb-4"><?= esc($event['event_name']); ?></h2>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Tanggal:</strong> <?= esc($event['event_date']); ?></p>
                        <p><strong>Lokasi:</strong> <?= esc($event['location']); ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Deskripsi:</strong> <?= esc($event['description']); ?></p>
                    </div>
                </div>

                <!-- Timer Countdown -->
                <h3 class="mt-4 text-center">Hitung Mundur Menuju Event</h3>
                <div id="countdown" class="alert alert-info text-center font-weight-bold"></div>

                <h3 class="mt-4 text-center">Detail Kategori</h3>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Kategori</th>
                                <th>Rute</th>
                                <th>Tanggal Mulai</th>
                                <th>Jam Mulai</th>
                                <th>Waktu Cut-Off</th>
                                <th>Biaya</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categories as $category) : ?>
                                <tr>
                                    <td><?= esc($category['nama_kategori']); ?></td>
                                    <td><?= esc($category['rute']); ?></td>
                                    <td><?= esc($category['start_date']); ?></td>
                                    <td><?= esc($category['start_jam']); ?></td>
                                    <td><?= esc($category['cut_off_time']); ?></td>
                                    <td>Rp <?= number_format(esc($category['biaya']), 0, ',', '.'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-between mt-4">
                    <div>
                        <?php if (!empty($categories) && $categories[0]['biaya'] == 0) : ?>
                            <a href="<?= base_url('pendaftaran/formGratis/' . $event['id']) ?>" class="btn btn-success">Mendaftar Gratis</a>
                        <?php elseif (!empty($categories) && $categories[0]['biaya'] > 0) : ?>
                            <a href="<?= base_url('pendaftaran/formBerbayar/' . $event['id']) ?>" class="btn btn-primary">Mendaftar Berbayar</a>
                        <?php endif; ?>
                    </div>
                    <div>
                        <a href="<?= site_url('user/user_dashboard'); ?>" class="btn btn-info">Kembali ke Dashboard</a>
                        <a href="<?= site_url('event/peserta/' . esc($event['id'])); ?>" class="btn btn-secondary">List Peserta</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Waktu event dimulai (diambil dari PHP dan diubah ke format JavaScript)
        const eventStart = new Date("<?= $event['event_date']; ?> <?= $categories[0]['start_jam']; ?>").getTime();

        // Update timer setiap 1 detik
        const timer = setInterval(() => {
            const now = new Date().getTime();
            const distance = eventStart - now;

            // Hitung waktu dalam hari, jam, menit, dan detik
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Tampilkan hasilnya
            document.getElementById("countdown").innerHTML =
                `${days} Hari ${hours} Jam ${minutes} Menit ${seconds} Detik`;

            // Jika waktu habis
            if (distance < 0) {
                clearInterval(timer);
                document.getElementById("countdown").innerHTML = "Event Telah Dimulai!";
            }
        }, 1000);
    </script>

    <?= $this->include('footer') ?>
</body>

</html>