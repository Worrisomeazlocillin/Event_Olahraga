<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Event</title>
    <!-- Link ke Bootstrap CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-5">Pembayaran untuk Event</h1>

        <!-- Menampilkan pesan flash -->
        <?php if (session()->getFlashdata('success_message')): ?>
            <div class="alert alert-success text-center" role="alert">
                <?= session()->getFlashdata('success_message'); ?>
            </div>
        <?php elseif (session()->getFlashdata('error_message')): ?>
            <div class="alert alert-danger text-center" role="alert">
                <?= session()->getFlashdata('error_message'); ?>
            </div>
        <?php endif; ?>

        <!-- Detail Event -->
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white">
                <h2 class="h5 mb-0">Detail Event</h2>
            </div>
            <div class="card-body">
                <p><strong>Nama Event :</strong> <?= htmlspecialchars($event_name) ?></p>
                <p><strong>Kategori Event :</strong> <?= htmlspecialchars($event_kategori) ?> </p> <!-- Menampilkan kategori event -->
                <p><strong>Rute :</strong> <?= htmlspecialchars($rute) ?> </p>
                <p><strong>Biaya :</strong> Rp <?= number_format($biaya, 2, ',', '.') ?></p>
            </div>
        </div>

        <!-- QR Code Pembayaran -->
        <div class="card shadow mb-4">
            <div class="card-header bg-secondary text-white text-center">
                <h2 class="h5 mb-0">Scan QR untuk Pembayaran</h2>
            </div>
            <div class="card-body text-center">
                <img src="<?= base_url('assets/qr_code/Contoh QR CODE Event Olahraga.png') ?>" alt="QR Payment" class="img-fluid mb-3" style="max-width: 200px;">
                <p class="text-muted">Gunakan QR ini untuk membayar dengan Dana/Gopay/Paypal dsb</p>
            </div>
        </div>

        <!-- Form Pembayaran -->
        <div class="card shadow mb-5">
            <div class="card-header bg-success text-white">
                <h2 class="h5 mb-0">Form Konfirmasi Pembayaran</h2>
            </div>
            <div class="card-body">
                <form action="<?= site_url('payment/submit_payment') ?>" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="jumlah_pembayaran" class="form-label">Jumlah Pembayaran:</label>
                        <input type="number" name="jumlah_pembayaran" class="form-control" step="0.01" required>
                    </div>

                    <div class="mb-3">
                        <label for="bukti_transfer" class="form-label">Upload Bukti Transfer:</label>
                        <input type="file" name="bukti_transfer" class="form-control" accept="image/*" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Kirim Pembayaran</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Link ke Bootstrap JS bundle via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



</body>

</html>