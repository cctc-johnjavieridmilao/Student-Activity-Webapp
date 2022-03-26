<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?= base_url('public/assets/js/jquery-3.3.1.js') ?>"></script>
<script src="<?= base_url('public/assets/js/vendor.bundle.base.js') ?>"></script>
<script src="<?= base_url('public/assets/js/sweetalert2.js') ?>"></script>
<script src="<?= base_url('public/assets/js/template.js') ?>"></script>
<script src="<?= base_url('public/assets/js/settings.js') ?>"></script>
<script src="<?= base_url('public/assets/js/off-canvas.js') ?>"></script>
<script src="<?= base_url('public/assets/js/bootstrap-4.min.js') ?>"></script>
<script src="<?= base_url('public/assets/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('public/assets/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('public/assets/js/choices.min.js') ?>"></script>
<script src="<?= base_url('public/assets/fullcalendar-5.10.1/lib/main.js') ?>"></script>

<script>

        function Logout() {
        var user_id = "<?= session('u_id') ?>";
        setTimeout(() => {
            window.location.href = "<?= base_url('Home/Logout') ?>";
        },2000);
      }
</script>
