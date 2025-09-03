<!-- Judul Halaman -->
<div class="text-center mb-5">
    <h1 class="fw-bold text-purple">Produk Kami</h1>
    <p class="text-muted">Temukan makanan & minuman favoritmu</p>
</div>

<!-- Pencarian -->
<div class="row mb-4">
    <div class="col-md-6 offset-md-3">
        <form class="d-flex" method="get">
            <input class="form-control me-2" type="search" name="q"
                value="<?= $this->input->get('q'); ?>"
                placeholder="Cari produk..." aria-label="Search">
            <button class="btn text-white" style="background-color:#6f42c1;" type="submit">
                <i class="bi bi-search"></i>
            </button>
        </form>
    </div>
</div>

<?php foreach ($kategori as $kat): ?>
    <h3 class="mb-3 text-purple"><?= $kat->produk_kategori ?></h3>
    <div class="row mb-3" id="row-<?= $kat->produk_kategori ?>">
        <?php
        if (!empty($produk_per_kategori[$kat->produk_kategori])):
            $count = 0;
            foreach ($produk_per_kategori[$kat->produk_kategori] as $p):
                $count++;
                $hidden_class = ($count > 3) ? 'd-none more-' . $kat->produk_kategori : '';
        ?>
                <div class="col-md-4 mb-4 <?= $hidden_class ?>">
                    <div class="card shadow-sm h-100">
                        <img src="<?= base_url('uploads/produk_sampul/' . $p->produk_sampul) ?>"
                            class="card-img-top" alt="<?= $p->produk_nama ?>">
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
        <?php else: ?>
            <p class="text-muted">Belum ada produk di kategori ini</p>
        <?php endif; ?>
    </div>

    <?php if (count($produk_per_kategori[$kat->produk_kategori]) > 3): ?>
        <div class="text-center mb-5">
            <button class="btn btn-outline-primary"
                style="border-color:#6f42c1; color:#6f42c1;"
                onclick="showMore('<?= $kat->produk_kategori ?>')">
                Lihat Lebih Banyak
            </button>
        </div>
    <?php endif; ?>
<?php endforeach; ?>

<script>
    function showMore(kategori) {
        document.querySelectorAll('.more-' + kategori).forEach(function(el) {
            el.classList.remove('d-none');
        });
        // hilangkan tombol
        event.target.style.display = 'none';
    }
</script>