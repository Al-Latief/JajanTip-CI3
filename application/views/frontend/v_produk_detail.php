<!-- Produk Detail -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Gambar Produk -->
            <div class="col-md-6 mb-4 mb-md-0 text-center">
                <img src="<?php echo base_url('uploads/produk_sampul/' . $produk->produk_sampul); ?>"
                    alt="<?php echo $produk->produk_nama; ?>"
                    class="img-fluid rounded shadow">
            </div>

            <!-- Detail Produk -->
            <div class="col-md-6">
                <h2 class="fw-bold text-purple mb-3">
                    <?php echo $produk->produk_nama; ?>
                </h2>
                <p class="text-muted">
                    <?php echo $produk->produk_deskripsi; ?>
                </p>

                <h4 class="fw-bold text-purple mb-3">
                    Rp<?php echo number_format($produk->produk_harga, 0, ',', '.'); ?>
                </h4>

                <p><strong>Kategori:</strong>
                    <span class="badge bg-primary">
                        <?php echo ucfirst($produk->produk_kategori); ?>
                    </span>
                </p>
                <p><strong>Stok:</strong>
                    <?php echo $produk->produk_stok > 0 ? $produk->produk_stok . ' tersedia' : 'Habis'; ?>
                </p>
                <p><strong>Tanggal Ditambahkan:</strong>
                    <?php echo date('d M Y', strtotime($produk->tanggal_ditambahkan)); ?>
                </p>

                <!-- Tombol Aksi -->
                <div class="mt-4">
                    <a href="https://wa.link/0rrbes" class="btn btn-lg text-white"
                        style="background-color:#6f42c1; border:none;" target="_blank">
                        <i class="bi bi-cart-fill me-2"></i> Pesan Via Whatsapp
                    </a>
                    <a href="<?php echo site_url('produk'); ?>"
                        class="btn btn-outline-secondary btn-lg ms-2">
                        <i class="bi bi-arrow-left me-2"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>