<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/bootstrap/css/bootstrap.min.css') ?>">
</head>
<body>

<div class="container mt-5">
    <!-- Bagian judul dan search bar -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="text-center mx-auto">
            <h1>EVENT OLAHRAGA</h1>
            <h2>List Event</h2>
        </div>

        <!-- Search Bar di Kanan Atas -->
        <form action="<?= base_url('event/search'); ?>" method="get" class="form-inline ml-auto">
            <div class="input-group">
                <input type="text" name="query" class="form-control" placeholder="Cari event..." value="<?= isset($searchQuery) ? $searchQuery : '' ?>">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </div>
        </form>
    </div>

    <div class="row">
        <?php if (isset($events) && !empty($events)): ?>
            <?php foreach ($events as $event): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?= base_url('uploads/' . $event['event_image']) ?>" class="card-img-top" alt="<?= $event['event_name'] ?>" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title" style="font-size: 1.5rem; font-weight: bold;"><?= $event['event_name'] ?></h5>
                            <p class="card-text">
                                <strong>Tanggal:</strong> <?= date('d M Y', strtotime($event['event_date'])) ?><br>
                                <strong>Lokasi:</strong> <?= $event['location'] ?><br>
                            </p>
                            <a href="<?= base_url('event/detail/' . $event['id']) ?>" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">Belum ada event yang tersedia.</p>
        <?php endif; ?>
    </div>
</div>

<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>

<?= $this->include('footer') ?>
