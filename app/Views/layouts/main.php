<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Event Registration</title>
    <!-- Add your CSS and JS includes here -->
    <link rel="stylesheet" href="<?= base_url('assets/css/adminlte.min.css') ?>">
    <script src="<?= base_url('assets/js/adminlte.min.js') ?>"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Include header -->
    <?= $this->include('header'); ?>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="<?= site_url('dashboard') ?>" class="brand-link">
            <img src="<?= base_url('assets/img/AdminLTELogo.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Event Registration</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a class="nav-link <?= $activePage == 'dashboard' ? 'active' : '' ?>" href="<?= site_url('dashboard') ?>">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <!-- Events -->
                    <li class="nav-item">
                        <a class="nav-link <?= $activePage == 'events' ? 'active' : '' ?>" href="<?= site_url('events') ?>">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>Events</p>
                        </a>
                    </li>
                    <!-- Pendaftaran -->
                    <li class="nav-item">
                        <a class="nav-link <?= $activePage == 'pendaftaran' ? 'active' : '' ?>" href="<?= site_url('pendaftaran/informasi') ?>">
                            <i class="nav-icon fas fa-registered"></i>
                            <p>Informasi Pendaftaran</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Your content goes here -->
                <?= $this->renderSection('content') ?>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Include footer -->
    <?= $this->include('footer'); ?>
    
</div>
<!-- ./wrapper -->
</body>
</html>
