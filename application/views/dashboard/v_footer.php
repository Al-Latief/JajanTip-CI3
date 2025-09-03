<footer class="footer">
    <div class="container-fluid">
        <nav>
            <p class="copyright text-center">
                ©
                <script>
                    document.write(new Date().getFullYear())
                </script>
                <a href="#">Muhammad Latip</a>, made with love for a better web
            </p>
        </nav>
    </div>
</footer>
</div>
</div>
</body>
<!--   Core JS Files   -->
<script src="<?php echo base_url() ?>/assets_dashboard/assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>/assets_dashboard/assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>/assets_dashboard/assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="<?php echo base_url() ?>/assets_dashboard/assets/js/plugins/bootstrap-switch.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--  Chartist Plugin  -->
<script src="<?php echo base_url() ?>/assets_dashboard/assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="<?php echo base_url() ?>/assets_dashboard/assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="<?php echo base_url() ?>/assets_dashboard/assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="<?php echo base_url() ?>/assets_dashboard/assets/js/demo.js"></script>

<!-- JS DataTables -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.3.3/js/dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>

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

</html>