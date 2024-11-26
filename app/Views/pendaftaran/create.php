<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Peserta Event</title>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/bootstrap/css/bootstrap.min.css') ?>">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Pendaftaran Event Olahraga</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <!-- Card with form -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Form Pendaftaran</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="<?= site_url('pendaftaran/store') ?>" method="post">
                                <?= csrf_field() ?>
                                <div class="card-body">
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
                                        <label for="id_event">Pilih Event:</label>
                                        <select class="form-control" id="id_event" name="id_event" required>
                                            <option value="">Pilih Event</option>
                                            <?php foreach($events as $event): ?>
                                                <option value="<?= $event['id'] ?>"><?= $event['event_name'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <!-- Pilihan Kategori Event -->
                                    <div class="form-group">
                                        <label for="id_kategori_event">Pilih Kategori Event:</label>
                                        <select class="form-control" id="id_kategori_event" name="id_kategori_event" required>
                                            <option value="">Pilih Kategori Event</option>
                                            <?php foreach($kategori_events as $kategori): ?>
                                                <option value="<?= $kategori['id'] ?>" data-rute="<?= $kategori['rute'] ?>" data-biaya="<?= $kategori['biaya'] ?>">
                                                    <?= $kategori['nama_kategori'] ?> (Rute: <?= $kategori['rute'] ?>)
                                                </option>
                                            <?php endforeach; ?>
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
                                            <?php foreach($provinsi as $prov): ?>
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
                                        <label for="kontak_darurat_no_hp">Kontak Darurat (No HP):</label>
                                        <input type="text" class="form-control" id="kontak_darurat_no_hp" name="kontak_darurat_no_hp">
                                    </div>

                                    <div class="form-group">
                                        <label for="kontak_darurat_nama">Kontak Darurat (Nama):</label>
                                        <input type="text" class="form-control" id="kontak_darurat_nama" name="kontak_darurat_nama">
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Daftar</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- AdminLTE App -->
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
                            $('#id_kabupaten').append('<option value="'+ value.id +'">'+ value.nama_kabupaten +'</option>');
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
        $('#id_kategori_event').change(function() {
            var selectedOption = $(this).find('option:selected');
            var biaya = selectedOption.data('biaya'); // Ambil data biaya dari opsi yang dipilih
            var rute = selectedOption.data('rute'); // Ambil data rute dari opsi yang dipilih
            
            $('#biaya').val(biaya); // Isi nilai biaya ke input biaya
            $('#rute').val(rute); // Isi nilai rute ke input rute
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
                            $('#id_kabupaten').append('<option value="'+ value.id +'">'+ value.nama_kabupaten +'</option>');
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

</body>
</html>
