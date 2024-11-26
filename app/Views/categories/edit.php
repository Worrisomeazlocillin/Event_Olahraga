<?= $this->include('header') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Kategori Event</h1>
                </div>
                <div class="col-sm-6">
                    <a href="<?= site_url('categories') ?>" class="btn btn-secondary float-sm-right">Kembali</a>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="<?= site_url('categories/update/' . $kategori['id']) ?>" method="post">
                                <div class="form-group">
                                    <label for="event_id">Nama Event</label>
                                    <select class="form-control" id="event_id" name="id_event" required>
                                        <option value="">Pilih Event</option>
                                        <?php foreach ($events as $event): ?>
                                            <option value="<?= $event['id'] ?>" <?= $kategori['id_event'] == $event['id'] ? 'selected' : '' ?>>
                                                <?= $event['event_name'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nama_kategori">Nama Kategori</label>
                                    <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="<?= $kategori['nama_kategori']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi_kategori">Deskripsi Kategori</label>
                                    <textarea class="form-control" id="deskripsi_kategori" name="deskripsi_kategori" required><?= $kategori['deskripsi_kategori']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="biaya">Biaya</label>
                                    <input type="number" class="form-control" id="biaya" name="biaya" value="<?= $kategori['biaya']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="rute">Rute</label>
                                    <input type="text" class="form-control" id="rute" name="rute" value="<?= $kategori['rute']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" value="<?= $kategori['start_date']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="start_jam">Start Jam</label>
                                    <input type="time" class="form-control" id="start_jam" name="start_jam" value="<?= $kategori['start_jam']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="cut_off_time">Cut Off Time</label>
                                    <input type="time" class="form-control" id="cut_off_time" name="cut_off_time" value="<?= $kategori['cut_off_time']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $kategori['keterangan']; ?>">
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->include('footer') ?>
