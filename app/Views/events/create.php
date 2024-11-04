<?= $this->include('header') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create New Event</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Event Form</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="<?= site_url('event/store'); ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="card-body">

                                <!-- Nama Event -->
                                <div class="form-group">
                                    <label for="event_name">Event Name:</label>
                                    <input type="text" name="event_name" id="event_name" required><br>
                                </div>

                                <!-- Tanggal Event -->
                                <div class="form-group">
                                    <label for="event_date">Tanggal Event</label>
                                    <input type="date" name="event_date" class="form-control" required>
                                </div>

                                <!-- Lokasi -->
                                <div class="form-group">
                                    <label for="location">Lokasi</label>
                                    <input type="text" name="location" class="form-control" placeholder="Enter location" required>
                                </div>

                                <!-- Deskripsi -->
                                <div class="form-group">
                                    <label for="description">Deskripsi</label>
                                    <textarea name="description" class="form-control" rows="3" placeholder="Enter event description" required></textarea>
                                </div>

                                <!-- Gambar Event -->
                                <div class="form-group">
                                    <label for="event_image">Gambar Event</label>
                                    <input type="file" name="event_image" class="form-control" accept="image/*" required>
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<?= $this->include('footer') ?>
