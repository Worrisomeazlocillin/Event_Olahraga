<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Event</title>
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/bootstrap/css/bootstrap.min.css') ?>">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .header {
            margin-left: 0;
            margin-right: 0;
            padding: 0px 0;
        }

        .container-fluid {
            padding-left: 0;
            padding-right: 0;
        }

        .modal-content {
            padding: 15px;
        }
    </style>
</head>

<body>

    <div class="header bg-light border-bottom py-2">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="mb-0">EVENT OLAHRAGA</h1>
            <?php if (session()->get('user_id')): ?>
                <!-- Tombol hanya tampil jika pengguna sudah login -->
                <div class="dropdown">
                    <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Menu
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" data-toggle="modal" data-target="#profileModal">Profil</a></li>
                        <li><a class="dropdown-item" href="<?= site_url('user/history-event'); ?>">Histori</a></li>
                        <li><a class="dropdown-item" data-toggle="modal" data-target="#contactModal">Kontak</a></li>
                        <li><a class="dropdown-item" data-toggle="modal" data-target="#aboutModal">About</a></li>
                        <li><a class="dropdown-item text-danger" data-toggle="modal" data-target="#logoutModal">Logout</a></li>
                    </ul>
                </div>
            <?php else: ?>
                <!-- Tombol Login jika pengguna belum login -->
                <a href="<?= site_url('user/login') ?>" class="btn btn-link">Login</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal Profil -->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileModalLabel">Profil Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Nama Pengguna:</strong> <?= session()->get('username') ?></p>
                    <p><strong>Email:</strong> <?= session()->get('email') ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Histori Event -->
    <div class="modal fade" id="eventHistoryModal" tabindex="-1" aria-labelledby="eventHistoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventHistoryModalLabel">Histori Event yang Diikuti</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="event-history-list">
                        <p class="text-muted">Memuat data...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Kontak -->
    <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactModalLabel">Kontak Kami</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Untuk informasi lebih lanjut, Anda dapat menghubungi kami melalui:</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-phone-alt"></i> <strong>Telepon:</strong> +62 812-3456-7890</li>
                        <li><i class="fas fa-envelope"></i> <strong>Email:</strong> info@eventolahraga.com</li>
                        <li><i class="fab fa-instagram"></i> <strong>Instagram:</strong> <a href="https://www.instagram.com/eventolahraga" target="_blank">@eventolahraga</a></li>
                        <li><i class="fab fa-facebook"></i> <strong>Facebook:</strong> <a href="https://www.facebook.com/eventolahraga" target="_blank">Event Olahraga</a></li>
                        <li><i class="fas fa-map-marker-alt"></i> <strong>Alamat:</strong> Jl. Olahraga No.123, Jakarta</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal About -->
    <div class="modal fade" id="aboutModal" tabindex="-1" aria-labelledby="aboutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="aboutModalLabel">Tentang Kami</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Pendaftaran Event Olahraga</strong> adalah platform digital yang menyediakan informasi dan layanan pendaftaran acara olahraga di Indonesia. Kami bertujuan untuk mempromosikan gaya hidup sehat dan aktif melalui berbagai acara olahraga, mempermudah pendaftaran, serta menyatukan komunitas olahraga di seluruh negeri.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin keluar?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <a href="<?= site_url('user/logout') ?>" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>