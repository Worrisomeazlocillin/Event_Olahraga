<?= $this->include('header') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create New Event Category</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Category Form</h3>
                        </div>

                        <!-- Form untuk membuat kategori event baru -->
                        <form action="<?= site_url('categories/store') ?>" method="post">
                            <?= csrf_field() ?>

                            <div class="card-body">
                                <!-- Dropdown untuk memilih event -->
                                <div class="form-group">
                                    <label for="event_id">Event Name</label>
                                    <select name="event_id" class="form-control" required>
                                        <option value="" disabled selected>Pilih Event</option>
                                        <?php foreach ($events as $event): ?>
                                            <option value="<?= $event['id']; ?>"><?= $event['event_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Nama Kategori -->
                                <div class="form-group">
                                    <label for="nama_kategori">Nama Kategori</label>
                                    <input type="text" name="nama_kategori" class="form-control" placeholder="Masukkan Nama Kategori" required>
                                </div>

                                <!-- Deskripsi Kategori -->
                                <div class="form-group">
                                    <label for="deskripsi_kategori">Deskripsi</label>
                                    <textarea name="deskripsi_kategori" class="form-control" rows="3" placeholder="Masukkan Deskripsi"></textarea>
                                </div>

                                <!-- Biaya -->
                                <div class="form-group">
                                    <label for="biaya">Biaya</label>
                                    <input type="number" name="biaya" class="form-control" placeholder="Masukkan Biaya" required>
                                </div>

                                <!-- Rute -->
                                <div class="form-group">
                                    <label for="rute">Rute</label>
                                    <input type="text" name="rute" class="form-control" placeholder="Masukkan Rute" required>
                                </div>

                                <!-- Tanggal Mulai -->
                                <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" name="start_date" class="form-control" required>
                                </div>

                                <!-- Waktu Mulai -->
                                <div class="form-group">
                                    <label for="start_jam">Start Time</label>
                                    <input type="time" name="start_jam" class="form-control" required>
                                </div>

                                <!-- Cut-off Time -->
                                <div class="form-group">
                                    <label for="cut_off_time">Cut-off Time</label>
                                    <input type="time" name="cut_off_time" class="form-control" required>
                                </div>

                                <!-- Keterangan -->
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea name="keterangan" class="form-control" rows="3" placeholder="Masukkan Keterangan"></textarea>
                                </div>
                            </div>

                            <!-- Tombol submit -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->include('footer') ?>
