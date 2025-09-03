</div> <!-- End Container -->
<?php
/**
 * @var M_data
 */
$CI = &get_instance();
$CI->load->model('M_data');
$pengaturan = $CI->M_data->get_data('pengaturan')->row();
?>
<!-- Footer -->
<footer>
    <p>&copy; <?php echo date("Y"); ?> <?= $pengaturan->pengaturan_nama_website ?>. All rights reserved.</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php if ($this->session->flashdata('success')): ?>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '<?= $this->session->flashdata('success') ?>',
            showConfirmButton: false,
            timer: 2000
        });
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '<?= $this->session->flashdata('error') ?>',
            showConfirmButton: true
        });
    <?php endif; ?>
</script>
</body>

</html>