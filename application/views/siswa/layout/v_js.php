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
<script src="<?= base_url('assets/front-end/plugins/chart.js/chart.min.js') ?>"></script>
<!-- Sweetalert2 -->
<script src="<?= base_url('assets/front-end/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>

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

<!-- My JS -->
<script src="<?= base_url('assets/front-end/dist/js/my-js.js') ?>"></script>

</body>

</html>
