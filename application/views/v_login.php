<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login & Registrasi - Jajan Tip</title>
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0px 8px 25px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background: #6a11cb;
            color: #fff;
            text-align: center;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }

        .btn-purple {
            background-color: #6a11cb;
            color: white;
            border-radius: 25px;
        }

        .btn-purple:hover {
            background-color: #5a0db3;
            color: #fff;
        }

        .nav-pills .nav-link {
            background-color: #fff;
            /* background putih */
            color: #6a11cb;
            /* teks ungu */
            border-radius: 25px;
            /* biar lebih lembut */
            margin: 0 5px;
            /* jarak antar tombol */
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .nav-pills .nav-link.active {
            background-color: #6a11cb !important;
            /* tetap ungu kalau aktif */
            color: #fff !important;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="login-tab" data-toggle="pill" href="#login" role="tab">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="register-tab" data-toggle="pill" href="#register" role="tab">Registrasi</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <!-- LOGIN -->
                    <div class="tab-pane fade show active" id="login" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <h4>Login</h4>
                            </div>
                            <div class="card-body">
                                <form action="<?= site_url('login/proses_login') ?>" method="post">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" placeholder="Masukkan username" name="pengguna_username" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" placeholder="Masukkan password" name="pengguna_password" required>
                                    </div>
                                    <button type="submit" class="btn btn-purple btn-block">Login</button>
                                </form>

                            </div>
                        </div>
                    </div>

                    <!-- REGISTER -->
                    <div class="tab-pane fade" id="register" role="tabpanel">
                        <div class="card">
                            <div class="card-header">
                                <h4>Registrasi</h4>
                            </div>
                            <div class="card-body">
                                <form action="<?= site_url('login/proses_register') ?>" method="post">
                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input type="text" class="form-control" placeholder="Masukkan nama lengkap" name="pengguna_nama" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" placeholder="Masukkan username" name="pengguna_username" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" placeholder="Buat password" name="pengguna_password" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Konfirmasi Password</label>
                                        <input type="password" class="form-control" placeholder="Ulangi password" name="pengguna_password2" required>
                                    </div>
                                    <button type="submit" class="btn btn-purple btn-block">Daftar</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap 4 JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        <?php if ($this->session->flashdata('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '<?= $this->session->flashdata('success') ?>',
                showConfirmButton: false,
                timer: 2000
            });
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '<?= $this->session->flashdata('error') ?>',
                showConfirmButton: true
            });
        <?php endif; ?>
    </script>

</body>

</html>