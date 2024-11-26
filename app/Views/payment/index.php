<!DOCTYPE html>
<html>

<head>
    <title>Daftar Pembayaran</title>
</head>

<body>
    <h1>Daftar Pembayaran</h1>

    <?php if (session()->getFlashdata('success')) : ?>
        <p><?= session()->getFlashdata('success') ?></p>
    <?php endif; ?>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Event</th>
                <th>Kategori</th>
                <th>Jumlah Pembayaran</th>
                <th>Status</th>
                <th>Scan KTP</th>
                <th>Bukti Transfer</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pembayaran as $row) : ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['id_user'] ?></td>
                    <td><?= $row['id_event'] ?></td>
                    <td><?= $row['event_kategori'] ?></td>
                    <td>Rp <?= number_format($row['jumlah_pembayaran'], 2, ',', '.') ?></td>
                    <td><?= $row['status_pembayaran'] ?></td>
                    <td><img src="<?= base_url('uploads/' . $row['scan_ktp']) ?>" width="100"></td>
                    <td><img src="<?= base_url('uploads/' . $row['bukti_transfer']) ?>" width="100"></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>