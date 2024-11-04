<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Berhasil</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .content-wrapper {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container content-wrapper">
        <h1 class="text-center">Pendaftaran Berhasil</h1>
        <div class="alert alert-success text-center" role="alert">
            <h4 class="alert-heading">Terima kasih!</h4>
            <p>Terima kasih telah mendaftar untuk event ini. Kami akan segera menghubungi Anda dengan informasi lebih lanjut.</p>
            <hr>
            <p class="mb-0">Jika Anda memiliki pertanyaan, silakan hubungi kami melalui email atau telepon yang tersedia.</p>
        </div>
        <div class="text-center">
            <a href="<?= site_url('user/user-dashboard'); ?>" class="btn btn-primary mt-3">Kembali ke Dashboard</a>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
