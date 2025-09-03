<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Table Chat</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover table-striped" id="myTable">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Nama Pengirim</th>
                                    <th>Pesan</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($pesan as $p): ?>
                                    <tr class="">
                                        <td class="align-middle text-center"><?= $no++ ?></td>
                                        <td class="align-middle"><?= $p->pengguna_nama ?></td>
                                        <td class="align-middle text-center"><?= $p->pesan_konten ?></td>
                                        <td class="align-middle text-center"><?= $p->tanggal_ditambahkan ?></td>
                                        <td class="align-middle text-center">
                                            <form action="<?= base_url('dashboard/pesan_status_edit_aksi') ?>" method="post">
                                                <input type="hidden" name="pesan_id" value="<?= $p->pesan_id ?>">
                                                <select name="pesan_status" onchange="this.form.submit()" class="form-control form-control-sm">
                                                    <option value="belum terbaca" <?= $p->pesan_status == 'belum terbaca' ? 'selected' : '' ?>>Belum terbaca</option>
                                                    <option value="terbaca" <?= $p->pesan_status == 'terbaca' ? 'selected' : '' ?>>Terbaca</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a href="<?= base_url('dashboard/pesan_hapus/' .
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