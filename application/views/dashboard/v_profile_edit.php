<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Profile</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?= base_url('dashboard/profile_edit_aksi') ?>" enctype="multipart/form-data">
                            <input type="hidden" name="pengguna_id" value="<?= $profile_edit->pengguna_id ?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" placeholder="Nama" value="<?= $profile_edit->pengguna_nama ?>" name="pengguna_nama">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" placeholder="Username" value="<?= $profile_edit->pengguna_username ?>" name="pengguna_username">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" placeholder="" value="<?= $profile_edit->pengguna_password ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input type="text" class="form-control" placeholder="Masuukan Password baru bila ingin" value="" name="pengguna_password">
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
                                                src="<?= base_url('uploads/pengguna_foto/' . $profile_edit->pengguna_foto) ?>"
                                                alt="Preview"
                                                style="width: 120px; height: 120px; object-fit: cover;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>