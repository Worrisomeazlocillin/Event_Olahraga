<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/bootstrap/css/bootstrap.min.css') ?>">
    <style>
        .header {
            background-color: #f8f9fa;
            padding: 10px 0;
        }

        .header .btn-link {
            color: #007bff;
            font-weight: bold;
        }

        body,
        html {
            margin: 0;
            padding: 0;
        }

        #countdown h5 {
            font-size: 1.25rem;
            margin: 5px;
        }

        .dropdown-toggle {
            background-color: transparent;
            color: black;
            border: none;
        }

        .dropdown-toggle:focus {
            box-shadow: none;
        }
    </style>
</head>

<body>

    <!-- Header dengan menu Kontak dan About -->
    <div class="header bg-light border-bottom py-2">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Judul berada di pojok kiri -->
            <h1 class="mb-0">EVENT OLAHRAGA</h1>

            <!-- Dropdown untuk semua mode -->
            <?php if (session()->get('user_id')): ?>
                <div class="dropdown"> <!-- Komponen dropdown -->
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Menu
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <button class="dropdown-item" type="button" data-toggle="modal" data-target="#profileModal">Lihat Profil</button>
                        <button class="dropdown-item" type="button" data-toggle="modal" data-target="#contactModal">Kontak</button>
                        <button class="dropdown-item" type="button" data-toggle="modal" data-target="#aboutModal">About</button>
                        <button class="dropdown-item" type="button" data-toggle="modal" data-target="#logoutModal">Logout</button>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Bagian judul utama -->
    <div class="container mt-3 text-center">
        <h1>List Event</h1>
    </div>

    <div class="container mt-5">

        <!-- Search Bar -->
        <div class="d-flex justify-content-center mb-4">
            <form action="<?= base_url('event/search'); ?>" method="get" class="form-inline">
                <div class="input-group">
                    <input type="text" name="query" class="form-control" placeholder="Cari event..." value="<?= isset($searchQuery) ? $searchQuery : '' ?>">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Hitung Mundur Menuju Event Terdekat -->
        <?php
        // Cari event terdekat berdasarkan tanggal
        $nearestEvent = null;
        if (isset($events) && !empty($events)) {
            usort($events, function ($a, $b) {
                return strtotime($a['event_date']) - strtotime($b['event_date']);
            });
            $nearestEvent = $events[0];
        }
        ?>
        <?php if ($nearestEvent): ?>
            <div class="text-center mt-5">
                <h3>Event Terdekat</h3>
                <h4><strong><?= $nearestEvent['event_name'] ?></strong></h4>
                <div class="d-flex justify-content-center mt-3">
                    <div class="card text-center" style="width: 18rem;">
                        <div class="card-body">
                            <div id="countdown"></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Daftar Event -->
        <div class="row">
            <?php if (isset($events) && !empty($events)): ?>
                <?php foreach ($events as $event): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="<?= base_url('uploads/' . $event['event_image']) ?>" class="card-img-top" alt="<?= $event['event_name'] ?>" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title text-center"><?= $event['event_name'] ?></h5>
                                <p class="card-text">
                                    <strong>Tanggal:</strong> <?= date('d M Y', strtotime($event['event_date'])) ?><br>
                                    <strong>Lokasi:</strong> <?= $event['location'] ?><br>
                                </p>
                                <?php if (session()->get('user_id')): ?>
                                    <!-- Tombol 'Lihat Detail' jika pengguna sudah login -->
                                    <a href="<?= base_url('event/detail/' . $event['id']) ?>" class="btn btn-primary">Daftar</a>
                                <?php else: ?>
                                    <!-- Tombol 'Login' jika pengguna belum login -->
                                    <a href="<?= site_url('user/login') ?>" class="btn btn-primary">Login untuk Daftar</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">Belum ada event yang tersedia.</p>
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
                        <!-- Tambahkan informasi profil lainnya sesuai dengan data yang tersedia di session -->
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

        <!-- Scripts -->
        <script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
        <script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

        <?php if ($nearestEvent): ?>
            <script>
                // Hitung mundur menuju event terdekat
                const eventDate = new Date("<?= date('Y-m-d H:i:s', strtotime($nearestEvent['event_date'])) ?>").getTime();
                const countdownElement = document.getElementById("countdown");

                function updateCountdown() {
                    const now = new Date().getTime();
                    const timeLeft = eventDate - now;

                    if (timeLeft > 0) {
                        const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                        const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                        countdownElement.innerHTML = `
                        <h5>${days} Hari, ${hours} Jam, ${minutes} Menit, ${seconds} Detik</h5>
                    `;
                    } else {
                        countdownElement.innerHTML = "<h5>Event telah dimulai!</h5>";
                        clearInterval(countdownInterval);
                    }
                }

                const countdownInterval = setInterval(updateCountdown, 1000);
                updateCountdown();
            </script>
        <?php endif; ?>

</body>

</html>

<?= $this->include('footer') ?>