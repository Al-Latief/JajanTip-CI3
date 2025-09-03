<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header ">
                        <h4 class="card-title">Table Products</h4>
                        <a href="<?php echo base_url('dashboard/produk_tambah') ?>" class="btn btn-sm btn-primary">Add Products</a>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover table-striped" id="myTable">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Stok</th>
                                    <th>Harga</th>
                                    <th>Kategori</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($produk as $p): ?>
                                    <tr class="">
                                        <td class="align-middle text-center"><?= $no++ ?></td>
                                        <td class="align-middle"><?= $p->produk_nama ?></td>
                                        <td class="align-middle text-center"><?= $p->produk_stok ?></td>
                                        <td class="align-middle text-center">Rp. <?= number_format($p->produk_harga, 0, ',', '.') ?></td>
                                        <td class="align-middle text-center"><?= $p->produk_kategori ?></td>
                                        <td class="align-middle text-center"><?= $p->tanggal_ditambahkan ?></td>
                                        <td class="align-middle text-center">
                                            <a href="<?= base_url('dashboard/produk_edit/' .
                                                            // Enkripsi Id
                                                            rtrim(strtr(base64_encode($this->encryption->encrypt($p->produk_id)), '+/', '-_'), '=')) ?>"
                                                class="btn btn-warning mr-1">
                                                Ubah
                                            </a>
                                            <a href="<?= base_url('dashboard/produk_hapus/' .
                                                            // Enkripsi Id
                                                            rtrim(strtr(base64_encode($this->encryption->encrypt($p->produk_id)), '+/', '-_'), '=')) ?>"
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