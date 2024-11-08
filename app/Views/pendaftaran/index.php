<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Pendaftaran</title>
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css') ?>">
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">
    <?= $this->include('header') ?> <!-- Memanggil header -->

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <div class="container mt-5">
            <h1>Data Pendaftaran</h1>
            
            <!-- Menampilkan pesan jika ada -->
            <?php if (session()->getFlashdata('message')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('message') ?>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ID Event</th>
                                <th>Nama Event</th>
                                <th>Kategori Event</th>
                                <th>Rute</th>
                                <th>Biaya</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>No HP</th>
                                <th>Alamat Lengkap</th>
                                <th>ID Provinsi</th>
                                <th>ID Kabupaten</th>
                                <th>Kewarganegaraan</th>
                                <th>Nama BIB</th>
                                <th>No Identitas</th>
                                <th>Golongan Darah</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Lahir</th>
                                <th>Riwayat Penyakit</th>
                                <th>Ukuran Kaos</th>
                                <th>Kontak Darurat (Nama Lengkap)</th>
                                <th>Kontak Darurat (No HP)</th>
                                <th>Kontak Darurat (Hubungan)</th>
                                <th>Persetujuan Peserta</th>
                                <th>Dibuat Pada</th>
                                <th>Diperbarui Pada</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pendaftaran as $p): ?>
                                <tr>
                                    <td><?= $p['id'] ?></td>
                                    <td><?= $p['id_event'] ?></td>
                                    <td><?= $p['event_name'] ?></td>
                                    <td><?= $p['kategori_event'] ?></td>
                                    <td><?= $p['rute'] ?></td>
                                    <td><?= $p['biaya'] ?></td>
                                    <td><?= $p['nama_lengkap'] ?></td>
                                    <td><?= $p['email'] ?></td>
                                    <td><?= $p['no_hp'] ?></td>
                                    <td><?= $p['alamat_lengkap'] ?></td>
                                    <td><?= $p['id_provinsi'] ?></td>
                                    <td><?= $p['id_kabupaten'] ?></td>
                                    <td><?= $p['kewarganegaraan'] ?></td>
                                    <td><?= $p['nama_bib'] ?></td>
                                    <td><?= $p['no_identitas'] ?></td>
                                    <td><?= $p['golongan_darah'] ?></td>
                                    <td><?= $p['jenis_kelamin'] ?></td>
                                    <td><?= $p['tanggal_lahir'] ?></td>
                                    <td><?= $p['riwayat_penyakit'] ?></td>
                                    <td><?= $p['ukuran_kaos'] ?></td>
                                    <td><?= $p['kontak_darurat_nama_lengkap'] ?></td>
                                    <td><?= $p['kontak_darurat_no_hp'] ?></td>
                                    <td><?= $p['kontak_darurat_hubungan'] ?></td>
                                    <td><?= $p['persetujuan_peserta'] ?></td>
                                    <td><?= $p['created_at'] ?></td>
                                    <td><?= $p['updated_at'] ?></td>
                                    <td>
                                        <!-- Tombol Edit dan Delete -->
                                        <a href="<?= base_url('pendaftaran/edit/' . $p['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="<?= base_url('pendaftaran/delete/' . $p['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus peserta ini?');">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?= $this->include('footer') ?> <!-- Memanggil footer -->
</div>

<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/dist/js/adminlte.min.js') ?>"></script>
</body>
</html>
