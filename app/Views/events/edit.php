<?= $this->include('header') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Event</h1>
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
                        <form action="<?= site_url('events/update/' . $event['id']); ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <label for="event_name">Event Name</label>
                                <input type="text" name="event_name" class="form-control" value="<?= $event['event_name']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="event_date">Event Date</label>
                                <input type="date" name="event_date" class="form-control" value="<?= $event['event_date']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" name="location" class="form-control" value="<?= $event['location']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" rows="3"><?= $event['description']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="event_image">Event Image</label>
                                <input type="file" name="event_image" class="form-control-file">
                                <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
                                <img src="<?= base_url('uploads/' . $event['event_image']) ?>" alt="Current Event Image" class="img-thumbnail mt-2" style="max-width: 200px;">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
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
