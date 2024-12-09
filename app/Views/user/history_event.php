<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event History Peserta</title>

    <!-- Link to Bootstrap CSS (using a CDN for Bootstrap 5) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"> <!-- FontAwesome for icons -->
</head>

<body>

    <!-- Header Section -->
    <div class="header bg-light border-bottom py-3">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <h1 class="mb-0">EVENT OLAHRAGA</h1>
            <?php if (session()->get('user_id')): ?>
                <!-- Dropdown menu for logged-in users -->
                <div class="dropdown">
                    <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Menu
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profileModal">Profil</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#contactModal">Kontak</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#aboutModal">About</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</a></li>
                    </ul>
                </div>
            <?php else: ?>
                <!-- Button for not logged-in users -->
                <a href="<?= site_url('user/login') ?>" class="btn btn-link">Login</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Main Container -->
    <div class="container-fluid mt-5">
        <h3 class="mb-4">Histori Event Peserta yang Diikuti</h3>

        <!-- Search Bar -->
        <form method="get" action="<?= site_url('user/history_event') ?>" class="mb-4">
            <div class="row">
                <div class="col-12 col-md-8 mb-2 mb-md-0">
                    <div class="form-group">
                        <input type="text" class="form-control" id="searchName" name="search" placeholder="Cari berdasarkan nama" value="<?= esc($search ?? '') ?>">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <button type="submit" class="btn btn-primary w-100">Cari</button>
                </div>
            </div>
        </form>

        <!-- Back Button -->
        <button type="button" class="btn btn-secondary mb-3" onclick="history.back()">Kembali</button>

        <!-- Check if there is any event history data -->
        <?php if (!empty($eventHistory)) : ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nama Lengkap</th>
                            <th>Nama Event</th>
                            <th>Nama Kategori</th>
                            <th>Event Dimulai</th>
                            <th>Kewarganegaraan</th>
                            <th>Tanggal Mendaftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($eventHistory as $history) : ?>
                            <tr>
                                <td><?= esc($history['nama_lengkap']); ?></td>
                                <td><?= esc($history['nama_event']); ?></td>
                                <td><?= esc($history['nama_kategori']); ?></td>
                                <td><?= esc($history['event_dimulai']); ?></td>
                                <td><?= esc($history['kewarganegaraan']); ?></td>
                                <td><?= esc($history['tanggal_mendaftar']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <div class="alert alert-warning">
                Belum ada histori event yang diikuti.
            </div>
        <?php endif; ?>
    </div>

    <!-- Modal Profil -->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileModalLabel">Profil Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Nama Pengguna:</strong> <?= session()->get('username') ?></p>
                    <p><strong>Email:</strong> <?= session()->get('email') ?></p>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin keluar?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="<?= site_url('user/logout') ?>" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Link to Bootstrap JS and Popper.js (for Bootstrap 5 functionality like dropdowns, modals, etc.) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>