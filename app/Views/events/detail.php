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
    <div class="container mt-5">
        <h1>Detail Event : <?= esc($event['event_name']); ?></h1>
        <p><strong>Tanggal:</strong> <?= esc($event['event_date']); ?></p>
        <p><strong>Lokasi:</strong> <?= esc($event['location']); ?></p>
        <p><strong>Deskripsi:</strong> <?= esc($event['description']); ?></p>

        <h3>Detail Kategori dan Biaya</h3>
        <table class="table table-bordered">
            <thead>
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
                <?php foreach ($categories as $category): ?>
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

        <!-- Tombol Mendaftar Gratis dan Berbayar -->
        <?php if (!empty($categories) && $categories[0]['biaya'] == 0): ?>
            <a href="<?= base_url('pendaftaran/formGratis/' . $event['id']) ?>" class="btn btn-success">Mendaftar Gratis</a>
        <?php elseif (!empty($categories) && $categories[0]['biaya'] > 0): ?>
            <a href="<?= base_url('pendaftaran/formBerbayar/' . $event['id']) ?>" class="btn btn-primary">Mendaftar Berbayar</a>
        <?php endif; ?>

        <!-- Tombol Kembali ke Dashboard -->
        <a href="<?= site_url('user/user_dashboard'); ?>" class="btn btn-info">Kembali ke Dashboard</a>

        <!-- Tombol List Peserta -->
        <a href="<?= site_url('event/peserta/' . esc($event['id'])); ?>" class="btn btn-secondary">List Peserta</a>
    </div>
</body>
</html>
