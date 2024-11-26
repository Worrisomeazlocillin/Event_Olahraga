<?= $this->include('header') ?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daftar Kategori Event</h1>
                </div>
                <div class="col-sm-6">
                    <?php if (!empty($events)): ?>
                        <a href="<?= site_url('categories/create/'.$events[0]['id']) ?>" class="btn btn-primary float-sm-right">Create Kategori Event</a>
                    <?php else: ?>
                        <a href="#" class="btn btn-secondary float-sm-right" disabled>No Event Available</a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Form Pencarian -->
            <div class="row mb-2">
                <div class="col-sm-12">
                    <form action="<?= site_url('kategorievent') ?>" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Cari Nama Event..." value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Kategori Event</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nama Event</th>
                                        <th>Nama Kategori</th>
                                        <th>Deskripsi</th>
                                        <th>Biaya</th>
                                        <th>Rute</th>
                                        <th>Start Date</th>
                                        <th>Start Jam</th>
                                        <th>Cut Off Time</th>
                                        <th>Keterangan</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (count($categories) > 0): ?>
                                        <?php foreach ($categories as $kategori): ?>
                                            <tr>
                                                <td><?= $kategori['id']; ?></td>
                                                <td><?= $kategori['event_name']; ?></td>
                                                <td><?= $kategori['nama_kategori']; ?></td>
                                                <td><?= $kategori['deskripsi_kategori']; ?></td>
                                                <td><?= $kategori['biaya']; ?></td>
                                                <td><?= $kategori['rute']; ?></td>
                                                <td><?= $kategori['start_date']; ?></td>
                                                <td><?= $kategori['start_jam']; ?></td>
                                                <td><?= $kategori['cut_off_time']; ?></td>
                                                <td><?= $kategori['keterangan']; ?></td>
                                                <td><?= $kategori['created_at']; ?></td>
                                                <td><?= $kategori['updated_at']; ?></td>
                                                <td>
                                                    <a href="<?= site_url('kategorievent/edit/'.$kategori['id']) ?>" class="btn btn-warning btn-sm">Edit</a>
                                                    <form action="<?= site_url('kategorievent/delete/'.$kategori['id']) ?>" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="13" class="text-center">Tidak ada kategori ditemukan.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->include('footer') ?>
