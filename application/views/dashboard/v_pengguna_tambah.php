<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add User</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?= base_url('dashboard/pengguna_tambah_aksi') ?>" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" placeholder="Nama" name="pengguna_nama">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" placeholder="Username" name="pengguna_username">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="pengguna_level">Level User</label>
                                        <select class="form-control" id="pengguna_level" name="pengguna_level" required>
                                            <option value="">-- Choose level --</option>
                                            <option value="Pengunjung">Pengunjung</option>
                                            <option value="Admin">Admin</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="text" class="form-control" placeholder="Password" name="pengguna_password" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="imageUpload" class="font-weight-bold">Upload Image</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="imageUpload" name="pengguna_foto">
                                        </div>
                                        <div class="text-center mt-3">
                                            <label class="custom-file-label" for="imageUpload">Pilih File Foto Di Sini..</label>
                                            <img class="img-thumbnail rounded-circle shadow-sm"
                                                src="<?= base_url('uploads/pengguna_foto/default.jpg') ?>"
                                                alt="Preview"
                                                style="width: 120px; height: 120px; object-fit: cover;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-fill pull-right">Add User</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>