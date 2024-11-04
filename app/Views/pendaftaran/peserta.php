<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Peserta</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>List Peserta untuk Event: <?= esc($event['event_name']); ?></h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>Rute</th>
                <th>Biaya</th>
                <th>Kewarganegaraan</th>
                <th>Ukuran Kaos</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($peserta)): ?>
                <?php foreach ($peserta as $index => $item): ?>
                    <tr>
                        <td><?= $index + 1; ?></td>
                        <td><?= esc($item['nama_lengkap']); ?></td>
                        <td><?= esc($item['rute']); ?></td>
                        <td><?= esc($item['biaya']); ?></td>
                        <td><?= esc($item['kewarganegaraan']); ?></td>
                        <td><?= esc($item['ukuran_kaos']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">Tidak ada peserta yang terdaftar untuk event ini.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="<?= site_url('event/detail/' . esc($event['id'])); ?>" class="btn btn-primary">Kembali ke Detail Event</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
