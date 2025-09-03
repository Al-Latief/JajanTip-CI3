<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    /**
     * @var M_data
     */
    $CI = &get_instance();
    $CI->load->model('M_data');
    $pengaturan = $CI->M_data->get_data('pengaturan')->row();
    ?>

    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url() ?>/assets_dashboard/assets/img/apple-icon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <link rel="icon" href="<?= base_url('uploads/pengaturan_logo_website/' . $pengaturan->pengaturan_logo_website) ?>" type="image/png">
    <title><?= $pengaturan->pengaturan_nama_website ?> | Dashboard</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="<?php echo base_url() ?>/assets_dashboard/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo base_url() ?>/assets_dashboard/assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="<?php echo base_url() ?>/assets_dashboard/assets/css/demo.css" rel="stylesheet" />

    <!-- CSS DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.3/css/dataTables.dataTables.min.css">

</head>

<body>
    <div class="wrapper">
        <div class="sidebar" data-image="<?php echo base_url() ?>/assets_dashboard/assets/img/sidebar-5.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="sidebar-wrapper">
                <div class="logo d-flex align-items-center justify-content-center">
                    <img src="<?= base_url('uploads/pengaturan_logo_website/' . $pengaturan->pengaturan_logo_website) ?>"
                        alt="Logo"
                        width="35" height="35"
                        class="mr-2 rounded-circle">
                    <a href="<?= base_url('dashboard') ?>" class="simple-text font-weight-bold text-dark mb-0">
                        <?= $pengaturan->pengaturan_nama_website ?>
                    </a>
                </div>

                <?php
                // Dapatkan segmen kedua dari URL, misal "dashboard/index", "produk", "pengguna" dll
                $current_segment = $this->uri->segment(2);
                ?>
                <ul class="nav">
                    <li class="nav-item <?= ($current_segment == '' || $current_segment == 'dashboard') ? 'active' : '' ?>">
                        <a class="nav-link" href="<?php echo base_url() ?>dashboard">
                            <i class="nc-icon nc-chart-pie-35"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item <?= ($current_segment == 'produk' || $current_segment == 'produk_tambah' || $current_segment == 'produk_edit') ? 'active' : '' ?>">
                        <a class="nav-link" href="<?php echo base_url() ?>dashboard/produk">
                            <i class="nc-icon nc-notes"></i>
                            <p>Product</p>
                        </a>
                    </li>
                    <li class="nav-item <?= ($current_segment == 'pesan') ? 'active' : '' ?>">
                        <a class="nav-link" href="<?php echo base_url('dashboard/pesan') ?>">
                            <i class="nc-icon nc-chat-round"></i>
                            <p>Chat</p>
                        </a>
                    </li>
                    <li class="nav-item <?= ($current_segment == 'pengguna' || $current_segment == 'pengguna_tambah' || $current_segment == 'pengguna_edit') ? 'active' : '' ?>">
                        <a class="nav-link" href="<?php echo base_url('dashboard/pengguna') ?>">
                            <i class="nc-icon nc-single-02"></i>
                            <p>Users</p>
                        </a>
                    </li>
                    <li class="nav-item <?= ($current_segment == 'pengaturan') ? 'active' : '' ?>">
                        <a class="nav-link" href="<?php echo base_url('dashboard/pengaturan') ?>">
                            <i class="nc-icon nc-settings-90"></i>
                            <p>Settings</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                <div class="container-fluid">
                    <?php if ($current_segment == '' || $current_segment == 'dashboard'): ?>
                        <a class="navbar-brand" href="<?php echo base_url('dashboard') ?>"> Dashboard </a>
                    <?php elseif ($current_segment == 'produk' || $current_segment == 'produk_tambah' || $current_segment == 'produk_edit'): ?>
                        <a class="navbar-brand" href="<?php echo base_url('dashboard/produk') ?>"> Product </a>
                    <?php elseif ($current_segment == 'pesan'): ?>
                        <a class="navbar-brand" href="<?php echo base_url('dashboard/pesan') ?>"> Chat </a>
                    <?php elseif ($current_segment == 'pengguna' || $current_segment == 'pengguna_tambah' || $current_segment == 'pengguna_edit'): ?>
                        <a class="navbar-brand" href="<?php echo base_url('dashboard/pengguna') ?>"> Users </a>
                    <?php elseif ($current_segment == 'pengaturan'): ?>
                        <a class="navbar-brand" href="<?php echo base_url('dashboard/pengaturan') ?>"> Settings </a>
                    <?php endif; ?>
                    <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                        <span class="navbar-toggler-bar burger-lines"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="no-icon"><i class="nc-icon nc-circle-09 mr-1"></i>Account</span>
                                </a>
                                <div class="dropdown-menu p-2" aria-labelledby="navbarDropdownMenuLink">
                                    <!-- User Panel -->
                                    <div class="user-panel d-flex align-items-center w-100">
                                        <div class="image">
                                            <img src="<?= base_url('uploads/pengguna_foto/default.jpg') ?>"
                                                class="img-circle elevation-2"
                                                alt="User Image"
                                                style="width:35px; height:35px; object-fit:cover;">
                                        </div>
                                        <div class="info ml-2">
                                            <span class="d-block fw-bold"><?= $this->session->userdata('pengguna_nama'); ?></span>
                                            <small class="text-success"><i class="nc-icon nc-circle"></i> Online</small>
                                            <a href="<?php echo base_url('dashboard/profile_edit') ?>" class="btn btn-sm btn-warning p-1"><i class="nc-icon nc-settings-gear-64 m-0 mr-1"></i>Setting</a>
                                        </div>
                                    </div>

                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url('login/logout') ?>">
                                    <span class="no-icon"><i class="nc-icon nc-button-power mr-1"></i>Log out</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->