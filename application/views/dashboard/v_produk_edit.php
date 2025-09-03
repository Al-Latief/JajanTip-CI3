<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Product</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?= base_url('dashboard/produk_edit_aksi') ?>" enctype="multipart/form-data">
                            <input type="hidden" name="produk_id" value="<?= $produk->produk_id ?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" placeholder="Nama Produk" value="<?= $produk->produk_nama ?>" name="produk_nama">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="text" class="form-control" placeholder="Harga Produk" value="<?= $produk->produk_harga ?>" name="produk_harga">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Stocks</label>
                                        <input type="text" class="form-control" placeholder="Stok Produk" value="<?= $produk->produk_stok ?>" name="produk_stok">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="produk_kategori">Category</label>
                                        <select class="form-control" name="produk_kategori" id="produk_kategori">
                                            <option value="">-- Pilih Kategori --</option>
                                            <option value="Makanan" <?= $produk->produk_kategori == "Makanan" ? "selected" : "" ?>>Makanan</option>
                                            <option value="Minuman" <?= $produk->produk_kategori == "Minuman" ? "selected" : "" ?>>Minuman</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="produk_deskripsi">Description</label>
                                        <textarea class="form-control" name="produk_deskripsi"><?= $produk->produk_deskripsi ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="imageUpload" class="font-weight-bold">Upload Image</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="imageUpload" value="" name="produk_sampul">
                                        </div>
                                        <div class="text-center mt-3">
                                            <label class="custom-file-label" for="imageUpload">Pilih File Gambar Sampul Produk Di Sini..</label>
                                            <img class="img-thumbnail shadow-sm"
                                                src="<?= base_url('uploads/produk_sampul/' . $produk->produk_sampul) ?>"
                                                alt="Preview"
                                                style="width: 120px; height: 120px; object-fit: cover;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-fill pull-right">Edit Product</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>