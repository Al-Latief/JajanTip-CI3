<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Website</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="<?= base_url('dashboard/pengaturan_edit_aksi') ?>" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" placeholder="Nama Website" value="<?= isset($pengaturan->pengaturan_nama_website) ? $pengaturan->pengaturan_nama_website : '' ?>" name="pengaturan_nama_website">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="imageUpload" class="font-weight-bold">Upload Image</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="imageUpload" name="pengaturan_logo_website">
                                        </div>
                                        <div class="text-center mt-3">
                                            <label class="custom-file-label" for="imageUpload">Pilih File Logo Di Sini..</label>
                                            <img class="img-thumbnail rounded-circle shadow-sm"
                                                src="<?= base_url('uploads/pengaturan_logo_website/' . (isset($pengaturan->pengaturan_logo_website) ? $pengaturan->pengaturan_logo_website : 'default.jpg')) ?>"
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