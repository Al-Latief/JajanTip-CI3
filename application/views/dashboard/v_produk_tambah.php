<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Product</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?= base_url('dashboard/produk_tambah_aksi') ?>" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" placeholder="Nama Produk" value="" name="produk_nama" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="text" class="form-control" placeholder="Harga Produk" value="" name="produk_harga" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Stocks</label>
                                        <input type="text" class="form-control" placeholder="Stok Produk" value="" name="produk_stok" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="produk_kategori">Category</label>
                                        <select class="form-control" id="produk_kategori" name="produk_kategori" required>
                                            <option value="">-- Pilih Kategori --</option>
                                            <option value="Makanan">Makanan</option>
                                            <option value="Minuman">Minuman</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="produk_deskripsi">Description</label>
                                        <textarea class="form-control" id="produk_deskripsi" name="produk_deskripsi" rows="4" placeholder="Deskripsi Produk" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="imageUpload" class="font-weight-bold">Upload Image</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="imageUpload" name="produk_sampul">
                                        </div>
                                        <div class="text-center mt-3">
                                            <label class="custom-file-label" for="imageUpload">Pilih File Gambar Produk Di Sini..</label>
                                            <img class="img-thumbnail shadow-sm"
                                                src="<?= base_url('uploads/produk_sampul/default.jpg') ?>"
                                                alt="Preview"
                                                style="width: 120px; height: 120px; object-fit: cover;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-fill pull-right">Add Product</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>