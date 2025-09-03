<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Judul -->
            <div class="text-center mb-4">
                <h2 class="fw-bold text-purple">Edit Profil</h2>
                <p class="text-muted">Perbarui informasi akunmu di bawah ini</p>
            </div>

            <!-- Form -->
            <form method="post" action="<?= base_url('jajantip/pengguna_edit_aksi') ?>" enctype="multipart/form-data" class="p-4 rounded shadow-sm" style="background-color:#f8f6fc;">
                <input type="hidden" name="pengguna_id" value="<?= $pengguna->pengguna_id ?>">

                <!-- Nama -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Nama</label>
                    <input type="text" class="form-control border-0 shadow-sm" placeholder="Nama"
                        value="<?= $pengguna->pengguna_nama ?>" name="pengguna_nama"
                        style="border-radius:10px;">
                </div>

                <!-- Username -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Username</label>
                    <input type="text" class="form-control border-0 shadow-sm" placeholder="Username"
                        value="<?= $pengguna->pengguna_username ?>" name="pengguna_username"
                        style="border-radius:10px;">
                </div>

                <!-- Password lama (readonly) -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Password Lama</label>
                    <input type="password" class="form-control border-0 shadow-sm"
                        value="<?= $pengguna->pengguna_password ?>" readonly
                        style="border-radius:10px; background-color:#f1f1f1;">
                </div>

                <!-- Password baru -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Password Baru</label>
                    <input type="text" class="form-control border-0 shadow-sm"
                        placeholder="Masukkan password baru bila ingin mengganti"
                        name="pengguna_password" style="border-radius:10px;">
                </div>

                <!-- Foto -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Foto Profil</label>
                    <input type="file" class="form-control border-0 shadow-sm" id="imageUpload" name="pengguna_foto" style="border-radius:10px;">

                    <div class="text-center mt-3">
                        <img class="rounded-circle shadow"
                            src="<?= base_url('uploads/pengguna_foto/' . $pengguna->pengguna_foto) ?>"
                            alt="Preview"
                            style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #6f42c1;">
                    </div>
                </div>

                <!-- Tombol -->
                <div class="d-grid mt-4">
                    <button type="submit" class="btn text-white py-2" style="background-color:#6f42c1; border-radius:10px; font-weight:600;">
                        Simpan Perubahan
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>