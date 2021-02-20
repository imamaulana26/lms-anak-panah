<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?= base_url('assets/front-end/plugins/jquery/jquery.min.js') ?>"></script>
<!-- <script src="https://cdn.ckeditor.com/ckeditor5/20.0.0/classic/ckeditor.js"></script> -->

<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/front-end/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<!-- DataTables -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<!-- Glider -->
<script src="<?= base_url('assets/front-end/plugins/glider/glider.min.js') ?>"></script>
<!-- Moment JS -->
<script src="<?= base_url('assets/front-end/plugins/moment/moment.min.js') ?>"></script>
<!-- ChartJs -->
<!--<script src="<?= base_url('assets/front-end/plugins/chart.js/chart.min.js') ?>"></script>-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" crossorigin="anonymous"></script>
<!-- Sweetalert2 -->
<script src="<?= base_url('assets/front-end/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
<!-- CK editor JS -->
<script src="<?= base_url('assets/plugins/ckeditor/ckeditor.js') ?>"></script>
<!-- Ekko Lightbox -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js" crossorigin="anonymous"></script>

<!-- AdminLTE App -->
<!-- <script src="dist/js/adminlte.min.js"></script> -->

<script>
	// Custome Dropdown menu
	$("li.dropdown.nav-item a").on("click", function(evt) {
		if (!$(this).parent().hasClass('show')) {
			$(this).parent().toggleClass("show");
		}
	});

	$("body").on("click", function(e) {
		if (
			!$("li.dropdown.nav-item").is(e.target) &&
			$("li.dropdown.nav-item").has(e.target).length === 0 &&
			$(".show").has(e.target).length === 0
		) {
			$("li.dropdown.nav-item").removeClass("show");
		}
	});
</script>
<?php if ($this->session->flashdata('msg') == 'deleted') : ?>
	<script type="text/javascript">
		Swal.fire({
			icon: 'error',
			title: 'Berhasil Di Hapus',
			text: 'Data Berhasil Di Hapus',
		})
	</script>

<?php elseif ($this->session->flashdata('msg') == 'success') : ?>
	<script type="text/javascript">
		Swal.fire({
			position: 'center',
			icon: 'success',
			title: 'Data Berhasil Di Simpan',
			showConfirmButton: false,
			timer: 1500
		})
	</script>
<?php elseif ($this->session->flashdata('msg') == 'info') : ?>
	<script type="text/javascript">
		Swal.fire({
			icon: 'info',
			title: 'Maaf Data Sudah Ada',
			text: 'Data Yang Anda Masukan Sudah ada di Database, Silahkan Input Ulang',
		})
	</script>
<?php elseif ($this->session->flashdata('msg') == 'test') : ?>
	<script type="text/javascript">
		Swal.fire(
			'Data Berhasil Di Simpan',
			'Terimakasih',
			'success'
		)
	</script>
<?php else : ?>

<?php endif; ?>
<!-- My JS -->
<script src="<?= base_url('assets/front-end/dist/js/my-js.js') ?>"></script>

</body>

</html>