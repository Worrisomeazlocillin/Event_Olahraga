<?= $this->include('header') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">EVENTS LIST</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All Events</h3>
                            <div class="card-tools">
                                <a href="<?= site_url('events/create'); ?>" class="btn btn-primary">Create New Event</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Tabel Event -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Event Name</th>
                                        <th>Event Date</th>
                                        <th>Location</th>
                                        <th>Description</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($events as $event): ?>
                                        <tr>
                                            <td><?= $event['id']; ?></td>
                                            <td><?= $event['event_name']; ?></td>
                                            <td><?= $event['event_date']; ?></td>
                                            <td><?= $event['location']; ?></td>
                                            <td><?= $event['description']; ?></td>
                                            <td><?= $event['created_at']; ?></td>
                                            <td><?= $event['updated_at']; ?></td>
                                            <td>
                                                <a href="<?= site_url('events/edit/' . $event['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                                <form action="<?= site_url('events/delete/' . $event['id']); ?>" method="post" style="display:inline;">
                                                    <?= csrf_field(); ?>
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this event?');">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <!-- Tabel Kategori Event -->
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?= $this->include('footer') ?>
