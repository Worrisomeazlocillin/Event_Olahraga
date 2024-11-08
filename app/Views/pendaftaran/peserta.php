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
                    <th>Kategori Event</th>
                    <th>Rute</th>
                    <th>Biaya</th>
                    <th>Kewarganegaraan</th>
                    <th>Ukuran Kaos</th>
                    <th>Persetujuan</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($pesertaList)): ?>
                    <?php foreach ($pesertaList as $index => $peserta): ?>
                        <tr>
                            <td><?= $index + 1; ?></td>
                            <td><?= esc($peserta['nama_lengkap']); ?></td>
                            <td><?= esc($peserta['kategori_event_nama']); ?></td>
                            <td><?= esc($peserta['rute']); ?></td>
                            <td><?= esc($peserta['biaya']); ?></td>
                            <td><?= esc($peserta['kewarganegaraan']); ?></td>
                            <td><?= esc($peserta['ukuran_kaos']); ?></td>
                            <td><?= esc($peserta['persetujuan_peserta']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada peserta yang terdaftar untuk event ini.</td>
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