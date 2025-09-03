 <?php
    /**
     * @var M_data
     */
    $CI = &get_instance();
    $CI->load->model('M_data');
    $pengaturan = $CI->M_data->get_data('pengaturan')->row();
    ?>
 <!-- Hero Section -->
 <div class="text-center mb-5">
     <h1 class="fw-bold text-purple">Selamat Datang di <?= $pengaturan->pengaturan_nama_website ?></h1>
     <p class="text-muted">Belanja mudah, cepat, dan terpercaya</p>
 </div>

 <!-- Produk Acak -->
 <h3 class="text-purple text-center mb-4" id="produk">✨ Produk Pilihan Untukmu</h3>
 <div class="row text-center">
     <?php foreach ($produk as $p): ?>
         <div class="col-md-4 mb-4">
             <div class="card shadow-sm h-100">
                 <img src="<?= base_url('uploads/produk_sampul/' . $p->produk_sampul) ?>"
                     class="card-img-top"
                     alt="<?= $p->produk_nama ?>">
                 <div class="card-body">
                     <h5 class="card-title"><?= $p->produk_nama ?></h5>
                     <p class="text-purple fw-bold">Rp<?= number_format($p->produk_harga, 0, ',', '.') ?></p>
                     <a href="<?php echo base_url('produk_detail/' .
                                    // Enkripsi Id
                                    rtrim(strtr(base64_encode($this->encryption->encrypt($p->produk_id)), '+/', '-_'), '=')) ?>" class="btn btn-primary w-100" style="background-color:#6f42c1; border:none;">
                         <i class="bi bi-cart-fill me-2"></i> Beli
                     </a>
                 </div>
             </div>
         </div>
     <?php endforeach; ?>
 </div>

 <!-- About Us Section -->
 <section class="py-5 bg-light" id="about">
     <div class="container">
         <div class="row align-items-center">
             <!-- Gambar di sisi kiri -->
             <div class="col-md-6 mb-4 mb-md-0 text-center">
                 <img src="https://picsum.photos/500/350"
                     alt="Tentang Kami"
                     class="img-fluid rounded shadow">
             </div>
             <!-- Teks di sisi kanan -->
             <div class="col-md-6">
                 <h2 class="fw-bold text-purple mb-3">Tentang Kami</h2>
                 <p class="text-muted">
                     Kami adalah <?= $pengaturan->pengaturan_nama_website ?> yang menyediakan berbagai produk makanan dan minuman
                     berkualitas. Dengan komitmen menghadirkan pengalaman belanja yang mudah,
                     cepat, dan terpercaya, kami siap melayani kebutuhan Anda.
                 </p>
                 <p class="text-muted">
                     Visi kami adalah menjadi platform belanja makanan dan minuman terbaik
                     dengan menghadirkan produk lokal maupun internasional yang selalu segar
                     dan berkualitas tinggi.
                 </p>
                 <a href="#contact" class="btn btn-primary mt-3" style="background-color:#6f42c1; border:none;">
                     Hubungi Kami
                 </a>
             </div>
         </div>
     </div>
 </section>


 <!-- Contact Us Section -->
 <section class="py-5" id="contact">
     <div class="container py-5">
         <div class="row justify-content-center">
             <div class="col-md-8">
                 <!-- Judul -->
                 <div class="text-center mb-4">
                     <h2 class="fw-bold text-purple">Hubungi Kami</h2>
                     <p class="text-muted">Informasi anda dijamin aman. Tenang saja..</p>
                 </div>

                 <!-- Form -->
                 <?php if ($this->session->userdata('status_login') && $this->session->userdata('pengguna_level') == "pengunjung"): ?>
                     <form action="<?= base_url('kirim_pesan') ?>" method="post" class="p-4 rounded shadow-sm" style="background-color:#f8f6fc;">
                         <input type="hidden" name="pengguna_id" value="<?= $this->session->userdata('pengguna_id') ?>">
                         <div class="mb-3">
                             <label class="form-label  fw-bold">Nama</label>
                             <input type="text" class="form-control border-0 shadow-sm"
                                 name="pengguna_nama"
                                 value="<?= $this->session->userdata('pengguna_nama') ?>"
                                 style="border-radius:10px;"
                                 readonly>
                         </div>
                         <div class="mb-3">
                             <label class="form-label  fw-bold">Pesan</label>
                             <textarea class="form-control border-0 shadow-sm" rows="4" name="pesan_konten" placeholder="Tulis pesan Anda" style="border-radius:10px;" required></textarea>
                         </div>
                         <!-- Tombol -->
                         <div class="d-grid mt-4">
                             <button type="submit" class="btn text-white py-2" style="background-color:#6f42c1; border-radius:10px; font-weight:600;">
                                 Kirim Pesan
                             </button>
                         </div>
                     </form>
                 <?php else: ?>
                     <div class="alert alert-warning">
                         Silakan <a href="<?= base_url('login') ?>">login</a> untuk bisa mengirim pesan.
                     </div>
                 <?php endif; ?>
             </div>
         </div>
     </div>

 </section>