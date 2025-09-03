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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= base_url('uploads/pengaturan_logo_website/' . $pengaturan->pengaturan_logo_website) ?>" type="image/png">
    <title><?= $pengaturan->pengaturan_nama_website ?></title>
    <!-- Bootstrap CSS & Icon -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #6f42c1;
            /* Ungu */
        }

        .navbar .nav-link,
        .navbar-brand {
            color: #fff !important;
        }

        footer {
            background-color: #6f42c1;
            color: white;
            padding: 15px 0;
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>

<body>

    <!-- Header / Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#"><?= $pengaturan->pengaturan_nama_website ?></a>
            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('') ?>">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('produk') ?>">Product</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('#about') ?>">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('#contact') ?>">Contact Us</a></li>
                    <ul class="navbar-nav ms-auto">
                        <?php if ($this->session->userdata('status_login') && $this->session->userdata('pengguna_level') == "pengunjung"): ?>
                            <!-- Sudah login -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="<?= base_url('uploads/pengguna_foto/' . $this->session->userdata('pengguna_foto')) ?>"
                                        alt="Foto Profil" class="rounded-circle me-2" width="30" height="30">
                                    <?= $this->session->userdata('pengguna_nama') ?>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="<?= base_url('pengguna_edit/' . rtrim(strtr(base64_encode($this->encryption->encrypt($this->session->userdata('pengguna_id'))), '+/', '-_'), '=')) ?>">Edit Profil</a></li>
                                    <li><a class="dropdown-item" href="<?= base_url('login/logout') ?>">Logout</a></li>
                                </ul>
                            </li>
                        <?php else: ?>
                            <!-- Belum login -->
                            <li class="nav-item">
                                <a class="nav-link" href="<?= base_url('login') ?>">Login</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">