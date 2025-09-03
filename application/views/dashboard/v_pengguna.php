<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Table Users</h4>
                        <a href="<?php echo base_url('dashboard/pengguna_tambah') ?>" class="btn btn-sm btn-primary">Add Users</a>

                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover table-striped" id="myTable">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Level</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($pengguna as $p): ?>
                                    <tr class="text-center">
                                        <td class="align-middle text-center"><?= $no++ ?></td>
                                        <td class="align-middle"><?= $p->pengguna_nama ?></td>
                                        <td class="align-middle text-center"><?= $p->pengguna_username ?></td>
                                        <td class="align-middle text-center"><span class="btn btn-sm btn-success"><?= $p->pengguna_level ?></span></td>
                                        <td class="align-middle text-center">
                                            <a href="<?= base_url('dashboard/pengguna_edit/' .
                                                            // Enkripsi Id
                                                            rtrim(strtr(base64_encode($this->encryption->encrypt($p->pengguna_id)), '+/', '-_'), '=')) ?>"
                                                class="btn btn-warning mr-1">
                                                Ubah
                                            </a>
                                            <a href="<?= base_url('dashboard/pengguna_hapus/' .
                                                            // Enkripsi Id
                                                            rtrim(strtr(base64_encode($this->encryption->encrypt($p->pengguna_id)), '+/', '-_'), '=')) ?>"
                                                class="btn btn-danger"
                                                onclick="return confirm('Yakin hapus?')">
                                                Hapus
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>