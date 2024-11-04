<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pendaftaran Peserta Event Berbayar</title>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/bootstrap/css/bootstrap.min.css') ?>">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Pendaftaran Event Olahraga Berbayar</h1>
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
                                <h3 class="card-title">Form Edit Pendaftaran Berbayar</h3>
                            </div>
                            <form action="<?= site_url('pendaftaran/updateBerbayar/' . $peserta['id']) ?>" method="post">
                                <?= csrf_field() ?>
                                <div class="form-group">
                                    <label for="nama_lengkap">Nama Lengkap:</label>
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $peserta['nama_lengkap'] ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?= $peserta['email'] ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="no_hp">No HP:</label>
                                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $peserta['no_hp'] ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="alamat_lengkap">Alamat Lengkap:</label>
                                    <textarea class="form-control" id="alamat_lengkap" name="alamat_lengkap"><?= $peserta['alamat_lengkap'] ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="event_name">Event:</label>
                                    <input type="text" class="form-control" id="event_name" name="event_name" value="<?= $event['event_name'] ?>" readonly>
                                    <input type="hidden" name="id_event" value="<?= $event['id'] ?>">
                                </div>

                                <div class="form-group">
                                    <label for="kategori_event">Pilih Kategori:</label>
                                    <select name="kategori_event" id="kategori_event" class="form-control" required>
                                        <option value="">Pilih Kategori Event</option>
                                        <?php if (isset($kategori_events)): ?>
                                            <?php foreach ($kategori_events as $kategori_event): ?>
                                                <option value="<?= $kategori_event['id']; ?>" 
                                                        data-biaya="<?= $kategori_event['biaya']; ?>" 
                                                        data-rute="<?= $kategori_event['rute']; ?>"
                                                        <?= $peserta['kategori_event'] == $kategori_event['id'] ? 'selected' : '' ?>>
                                                    <?= $kategori_event['nama_kategori']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="rute">Rute:</label>
                                    <input type="text" class="form-control" id="rute" name="rute" value="<?= $peserta['rute'] ?>" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="biaya">Biaya:</label>
                                    <input type="text" class="form-control" id="biaya" name="biaya" value="<?= $peserta['biaya'] ?>" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="id_provinsi">Pilih Provinsi:</label>
                                    <select class="form-control" id="id_provinsi" name="id_provinsi" required>
                                        <option value="">Pilih Provinsi</option>
                                        <?php foreach($provinsi as $prov): ?>
                                            <option value="<?= $prov['id'] ?>" <?= $peserta['id_provinsi'] == $prov['id'] ? 'selected' : '' ?>><?= $prov['nama_provinsi'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="id_kabupaten">Pilih Kabupaten:</label>
                                    <select class="form-control" id="id_kabupaten" name="id_kabupaten" required>
                                        <option value="">Pilih Kabupaten</option>
                                    </select>
                                </div>

                                <!-- Additional Fields -->
                                <div class="form-group">
                                    <label for="kewarganegaraan">Kewarganegaraan:</label>
                                    <input type="text" class="form-control" id="kewarganegaraan" name="kewarganegaraan" value="<?= $peserta['kewarganegaraan'] ?>">
                                </div>

                                <div class="form-group">
                                    <label for="nama_bib">Nama Bib:</label>
                                    <input type="text" class="form-control" id="nama_bib" name="nama_bib" value="<?= $peserta['nama_bib'] ?>">
                                </div>

                                <div class="form-group">
                                    <label for="no_identitas">No Identitas:</label>
                                    <input type="text" class="form-control" id="no_identitas" name="no_identitas" value="<?= $peserta['no_identitas'] ?>">
                                </div>

                                <div class="form-group">
                                    <label for="golongan_darah">Golongan Darah:</label>
                                    <select class="form-control" id="golongan_darah" name="golongan_darah">
                                        <option value="A" <?= $peserta['golongan_darah'] == 'A' ? 'selected' : '' ?>>A</option>
                                        <option value="B" <?= $peserta['golongan_darah'] == 'B' ? 'selected' : '' ?>>B</option>
                                        <option value="AB" <?= $peserta['golongan_darah'] == 'AB' ? 'selected' : '' ?>>AB</option>
                                        <option value="O" <?= $peserta['golongan_darah'] == 'O' ? 'selected' : '' ?>>O</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin:</label>
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                        <option value="L" <?= $peserta['jenis_kelamin'] == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                        <option value="P" <?= $peserta['jenis_kelamin'] == 'P' ? 'selected' : '' ?>>Perempuan</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir:</label>
                                    <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= $peserta['tanggal_lahir'] ?>">
                                </div>

                                <div class="form-group">
                                    <label for="riwayat_penyakit">Riwayat Penyakit:</label>
                                    <textarea class="form-control" id="riwayat_penyakit" name="riwayat_penyakit"><?= $peserta['riwayat_penyakit'] ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="ukuran_kaos">Ukuran Kaos:</label>
                                    <select class="form-control" id="ukuran_kaos" name="ukuran_kaos">
                                        <option value="S" <?= $peserta['ukuran_kaos'] == 'S' ? 'selected' : '' ?>>S</option>
                                        <option value="M" <?= $peserta['ukuran_kaos'] == 'M' ? 'selected' : '' ?>>M</option>
                                        <option value="L" <?= $peserta['ukuran_kaos'] == 'L' ? 'selected' : '' ?>>L</option>
                                        <option value="XL" <?= $peserta['ukuran_kaos'] == 'XL' ? 'selected' : '' ?>>XL</option>
                                        <option value="XXL" <?= $peserta['ukuran_kaos'] == 'XXL' ? 'selected' : '' ?>>XXL</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="upload_bukti">Upload Bukti Pembayaran:</label>
                                    <input type="file" class="form-control-file" id="upload_bukti" name="upload_bukti">
                                    <small class="form-text text-muted">* Jika ingin mengubah bukti pembayaran, silahkan upload file baru.</small>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    <a href="<?= site_url('pendaftaran/indexBerbayar') ?>" class="btn btn-secondary">Kembali</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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


</body>
</html>
