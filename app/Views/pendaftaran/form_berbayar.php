<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pembayaran</title>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/bootstrap/css/bootstrap.min.css') ?>">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?= $this->include('header_user') ?>
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Formulir Pembayaran</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Form Pendaftaran Berbayar</h3>
                                </div>
                                <form action="<?= site_url(relativePath: 'pendaftaran/storeBerbayar') ?>" method="post">
                                    <?= csrf_field() ?>
                                    <div class="form-group">
                                        <label for="nama_lengkap">Nama Lengkap:</label>
                                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="no_hp">No HP:</label>
                                        <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="alamat_lengkap">Alamat Lengkap:</label>
                                        <textarea class="form-control" id="alamat_lengkap" name="alamat_lengkap"></textarea>
                                    </div>

                                    <!-- Pilihan Event -->
                                    <div class="form-group">
                                        <label for="event_name">Event:</label>
                                        <input type="text" class="form-control" id="event_name" name="event_name" value="<?= $event['event_name'] ?>" readonly>
                                        <input type="hidden" name="id_event" value="<?= $event['id'] ?>">
                                    </div>

                                    <!-- Pilihan Kategori Event -->
                                    <div class="form-group">
                                        <label for="kategori_event">Pilih Kategori:</label>
                                        <select name="kategori_event" id="kategori_event" class="form-control">
                                            <option value="">Pilih Kategori Event</option>
                                            <?php if (isset($kategori_events)): ?>
                                                <?php foreach ($kategori_events as $kategori_event): ?>
                                                    <option value="<?= $kategori_event['id']; ?>"
                                                        data-biaya="<?= $kategori_event['biaya']; ?>"
                                                        data-rute="<?= $kategori_event['rute']; ?>">
                                                        <?= $kategori_event['nama_kategori']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="rute">Rute:</label>
                                        <input type="text" class="form-control" id="rute" name="rute" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="biaya">Biaya:</label>
                                        <input type="text" class="form-control" id="biaya" name="biaya" readonly>
                                    </div>


                                    <!-- Pilihan Provinsi -->
                                    <div class="form-group">
                                        <label for="id_provinsi">Pilih Provinsi:</label>
                                        <select class="form-control" id="id_provinsi" name="id_provinsi" required>
                                            <option value="">Pilih Provinsi</option>
                                            <?php foreach ($provinsi as $prov): ?>
                                                <option value="<?= $prov['id'] ?>"><?= $prov['nama_provinsi'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <!-- Pilihan Kabupaten -->
                                    <div class="form-group">
                                        <label for="id_kabupaten">Pilih Kabupaten:</label>
                                        <select class="form-control" id="id_kabupaten" name="id_kabupaten" required>
                                            <option value="">Pilih Kabupaten</option>
                                        </select>
                                    </div>

                                    <!-- Additional Fields -->
                                    <div class="form-group">
                                        <label for="kewarganegaraan">Kewarganegaraan:</label>
                                        <input type="text" class="form-control" id="kewarganegaraan" name="kewarganegaraan">
                                    </div>

                                    <div class="form-group">
                                        <label for="nama_bib">Nama Bib:</label>
                                        <input type="text" class="form-control" id="nama_bib" name="nama_bib">
                                    </div>

                                    <div class="form-group">
                                        <label for="no_identitas">No Identitas:</label>
                                        <input type="text" class="form-control" id="no_identitas" name="no_identitas">
                                    </div>

                                    <div class="form-group">
                                        <label for="golongan_darah">Golongan Darah:</label>
                                        <select class="form-control" id="golongan_darah" name="golongan_darah">
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="AB">AB</option>
                                            <option value="O">O</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="jenis_kelamin">Jenis Kelamin:</label>
                                        <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="tanggal_lahir">Tanggal Lahir:</label>
                                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                                    </div>

                                    <div class="form-group">
                                        <label for="riwayat_penyakit">Riwayat Penyakit:</label>
                                        <textarea class="form-control" id="riwayat_penyakit" name="riwayat_penyakit"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="ukuran_kaos">Ukuran Kaos:</label>
                                        <select class="form-control" id="ukuran_kaos" name="ukuran_kaos">
                                            <option value="S">S</option>
                                            <option value="M">M</option>
                                            <option value="L">L</option>
                                            <option value="XL">XL</option>
                                            <option value="XXL">XXL</option>
                                            <option value="XXXL">XXXL</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="kontak_darurat_nama_lengkap">Nama Lengkap Kontak Darurat:</label>
                                        <input type="text" class="form-control" id="kontak_darurat_nama_lengkap" name="kontak_darurat_nama_lengkap">
                                    </div>

                                    <div class="form-group">
                                        <label for="kontak_darurat_no_hp">No HP Kontak Darurat:</label>
                                        <input type="text" class="form-control" id="kontak_darurat_no_hp" name="kontak_darurat_no_hp">
                                    </div>

                                    <div class="form-group">
                                        <label for="kontak_darurat_hubungan">Hubungan dengan Kontak Darurat:</label>
                                        <input type="text" class="form-control" id="kontak_darurat_hubungan" name="kontak_darurat_hubungan">
                                    </div>

                                    <div class="form-group">
                                        <label for="persetujuan_peserta">Persetujuan Peserta:</label>
                                        <input type="checkbox" id="persetujuan_peserta" name="persetujuan_peserta" required>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Daftar</button>
                                        <a href="<?= site_url('event/detail/' . $event_id) ?>" class="btn btn-secondary">Kembali</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('assets/dist/js/adminlte.min.js') ?>"></script>

    <script>
        $(document).ready(function() {
            $('#id_provinsi').change(function() {
                var id_provinsi = $(this).val();
                if (id_provinsi) {
                    $.ajax({
                        url: "<?= site_url('pendaftaran/get_kabupaten') ?>/" + id_provinsi,
                        method: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#id_kabupaten').empty();
                            $('#id_kabupaten').append('<option value="">Pilih Kabupaten</option>');
                            $.each(data, function(key, value) {
                                $('#id_kabupaten').append('<option value="' + value.id + '">' + value.nama_kabupaten + '</option>');
                            });
                        }
                    });
                } else {
                    $('#id_kabupaten').empty();
                    $('#id_kabupaten').append('<option value="">Pilih Kabupaten</option>');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Update biaya and rute when kategori event is selected
            $('#kategori_event').change(function() {
                // Ambil data biaya dan rute dari option yang dipilih
                var selectedOption = $(this).find('option:selected');
                var biaya = selectedOption.data('biaya');
                var rute = selectedOption.data('rute');

                // Isi field biaya dan rute
                $('#biaya').val(biaya);
                $('#rute').val(rute);
            });

            // Mengambil data kabupaten berdasarkan provinsi yang dipilih
            $('#id_provinsi').change(function() {
                var id_provinsi = $(this).val();
                if (id_provinsi) {
                    $.ajax({
                        url: "<?= site_url('pendaftaran/get_kabupaten') ?>/" + id_provinsi,
                        method: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#id_kabupaten').empty();
                            $('#id_kabupaten').append('<option value="">Pilih Kabupaten</option>');
                            $.each(data, function(key, value) {
                                $('#id_kabupaten').append('<option value="' + value.id + '">' + value.nama_kabupaten + '</option>');
                            });
                        }
                    });
                } else {
                    $('#id_kabupaten').empty();
                    $('#id_kabupaten').append('<option value="">Pilih Kabupaten</option>');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#id_event').change(function() {
                var eventId = $(this).val();
                $.ajax({
                    url: '/pendaftaran/getKategoriEventByEvent/' + eventId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var options = '<option value="">Pilih Kategori Event</option>';
                        $.each(data, function(key, val) {
                            options += '<option value="' + val.id + '">' + val.nama_kategori_event + '</option>';
                        });
                        $('#id_kategori_event').html(options);
                    }
                });
            });
        });
    </script>

    <?= $this->include('footer') ?>
</body>

</html>