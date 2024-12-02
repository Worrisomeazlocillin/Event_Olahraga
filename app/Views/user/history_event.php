<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event History</title>

    <!-- Link to Bootstrap CSS (using a CDN for convenience) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <!-- Header Section -->
    <div class="header bg-light border-bottom py-2">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <h1 class="mb-0">EVENT OLAHRAGA</h1>
            <?php if (session()->get('user_id')): ?>
                <!-- Dropdown menu for logged-in users -->
                <div class="dropdown">
                    <button class="btn btn-link dropdown-toggle" type="button" id="userMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Menu
                    </button>
                    <div class="dropdown-menu" aria-labelledby="userMenu">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#profileModal">Lihat Profil</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#contactModal">Kontak</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#aboutModal">About</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
                    </div>
                </div>
            <?php else: ?>
                <!-- Button for not logged-in users -->
                <a href="<?= site_url('user/login') ?>" class="btn btn-link">Login</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Main Container -->
    <div class="container-fluid mt-5">
        <h3 class="mb-4">Histori Event yang Diikuti</h3>

        <!-- Search Bar -->
        <form method="get" action="<?= site_url('user/history_event') ?>" class="mb-4">
            <div class="form-group">
                <label for="searchName">Cari Nama</label>
                <input type="text" class="form-control" id="searchName" name="search" placeholder="Cari berdasarkan nama" value="<?= esc($search ?? '') ?>">
            </div>
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>

        <!-- Back Button -->
        <button type="button" class="btn btn-secondary mb-3" onclick="history.back()">Kembali</button>

        <!-- Check if there is any event history data -->
        <?php if (!empty($eventHistory)) : ?>
            <!-- Table to display the event history -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nama Lengkap</th>
                            <th>Nama Event</th>
                            <th>Kategori Event</th>
                            <th>Ukuran Kaos</th>
                            <th>Kewarganegaraan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($eventHistory as $history) : ?>
                            <tr>
                                <td><?= esc($history['nama_lengkap']); ?></td>
                                <td><?= esc($history['id_event']); ?></td>
                                <td><?= esc($history['kategori_event']); ?></td>
                                <td><?= esc($history['ukuran_kaos']); ?></td>
                                <td><?= esc($history['kewarganegaraan']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else : ?>
            <!-- If no event history, display a message -->
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

    <!-- Link to Bootstrap JS and Popper.js (for Bootstrap functionality like tooltips, modals, etc.) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>