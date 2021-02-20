<!--Counter Inbox-->
<?php
$query = $this->db->query("SELECT * FROM tbl_inbox WHERE inbox_status='1'");
$jum_pesan = $query->num_rows();
?>
<?php
$id_admin = $this->session->userdata('idadmin');
$q = $this->db->query("SELECT * FROM tbl_pengguna WHERE pengguna_id='$id_admin'");
$c = $q->row_array();
?>
<?php
if ($c['pengguna_level'] == 2) {
	$url = base_url() . 'dashboard';
	header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
	exit();
	// die();
};
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SEKOLAH ANAK PANAH | Keuangan</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, siswa-scalable=no" name="viewport">
	<link rel="shorcut icon" type="text/css" href="<?php echo base_url() . 'assets/images/favicon.png' ?>">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="<?php echo base_url() . 'assets/bootstrap/css/bootstrap.min.css' ?>">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url() . 'assets/font-awesome/css/font-awesome.min.css' ?>">
	<!-- DataTables -->
	<link rel="stylesheet" href="<?php echo base_url() . 'assets/plugins/datatables/dataTables.bootstrap.css' ?>">
	<!-- Datepicker -->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') ?>">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url() . 'assets/dist/css/AdminLTE.min.css' ?>">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="<?php echo base_url() . 'assets/dist/css/skins/_all-skins.min.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/plugins/toast/jquery.toast.min.css' ?>" />



</head>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

		<?php
		$this->load->view('admin/v_header');
		?>
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
				<!-- /.search form -->
				<!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu">

					<li class="header">Menu Utama</li>
					<?php if ($c['pengguna_level'] == 1) : ?>

						<li>
							<a href="<?php echo base_url() . 'dashboard' ?>">
								<i class="fa fa-home"></i> <span>Dashboard</span>
								<span class="pull-right-container">
									<small class="label pull-right"></small>
								</span>
							</a>
						</li>
						
						<li>
              <a href="<?php echo base_url() . 'jadwal' ?>">
                <i class="fa fa-calendar"></i> <span>Kalendar</span>
                <span class="pull-right-container">
                  <small class="p pull-right"></small>
                </span>
              </a>
            </li>

						<li>
							<a href="<?php echo base_url() . 'datalembaga' ?>">
								<i class="fa fa-building"></i> <span>Lembaga</span>
								<span class="pull-right-container">
									<small class="label pull-right"></small>
								</span>
							</a>
						</li>

						<li>
							<a href="<?php echo base_url() . 'satelit' ?>">
								<i class="fa fa-rocket"></i> <span>Data Satelit</span>
								<span class="pull-right-container">
									<small class="label pull-right"></small>
								</span>
							</a>
						</li>


						<li>
							<a href="<?php echo base_url() . 'pegawai' ?>">
								<i class="fa fa-server" aria-hidden="true"></i>
								<span>Pegawai</span>
								<span class="pull-right-container">
									<small class="label pull-right"></small>
								</span>
							</a>
						</li>

						<li class="treeview">
							<a href="#">
								<i class="fa fa-user"></i>
								<span>Kesiswaan</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?php echo base_url() . 'siswa' ?>"><i class="fa fa-users"></i> Data Siswa</a></li>
								<li><a href="<?php echo base_url() . 'siswa_keluar' ?>"><i class="fa fa-star-o"></i> PD Keluar</a></li>
							</ul>
						</li>


						<li class="treeview">
							<a href="#">
								<i class="fa fa-files-o"></i>
								<span>E-Raport</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?php echo base_url() . 'mapel' ?>"><i class="fa fa-list-ol"></i> Mapel</a></li>
								<li><a href="<?php echo base_url() . 'nilai_raport' ?>"><i class="fa fa-sort-numeric-asc"></i> Nilai Raport</a></li>
							</ul>
						</li>

						<li>
							<a href="<?php echo base_url() . 'kisikisi' ?>">
								<i class="fa fa-file-text"></i> <span>Kisi-Kisi</span>
								<span class="pull-right-container">
									<small class="label pull-right bg-green"></small>
								</span>
							</a>
						</li>

						<li class="active">
							<a href="<?php echo base_url() . 'keuangan' ?>">
								<i class="fa fa-money"></i> <span>Keuangan</span>
								<span class="pull-right-container">
									<small class="label pull-right bg-green"></small>
								</span>
							</a>
						</li>


					<?php else : ?>

						<li class="active">
							<a href="<?php echo base_url() . 'dashboard-siswa' ?>">
								<i class="fa fa-home"></i> <span>Dashboard</span>
								<span class="pull-right-container">
									<small class="label pull-right"></small>
								</span>
							</a>
						</li>

						<li>
							<a href="<?php echo base_url() . 'keuangan-siswa' ?>">
								<i class="fa fa-calendar"></i> <span>Keuangan</span>
								<span class="pull-right-container">
									<small class="label pull-right"></small>
								</span>
							</a>
						</li>


						<li>
							<a href="<?php echo base_url() . 'kisikisi' ?>">
								<i class="fa fa-calendar"></i> <span>Kisi - Kisi</span>
								<span class="pull-right-container">
									<small class="label pull-right"></small>
								</span>
							</a>
						</li>

						<li>
							<a href="#">
								<i class="fa fa-calendar"></i> <span>Evaluasi</span>
								<span class="pull-right-container">
									<small class="label pull-right"></small>
								</span>
							</a>
						</li>

					<?php endif ?>
					<li>
						<a href="<?php echo base_url() . 'login/logout' ?>">
							<i class="fa fa-sign-out"></i> <span>Sign Out</span>
							<span class="pull-right-container">
								<small class="label pull-right"></small>
							</span>
						</a>
					</li>
				</ul>
			</section>
			<!-- /.sidebar -->
		</aside>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					Data Siswa
					<small></small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li class="active">Keuangan</li>

				</ol>
			</section>
			<!-- Main content -->
			<section class="content">
				<div class="row">
					<div class="col-xs-12">
						<div class="box">
							<div class="box">
								<div class="box-header">
									<label class="control-label">Filter Kelas</label>
									<div class="row">
										<div class="col-md-4">
											<select id="kategori" class="form-control">
												<option selected="true" disabled="true">pilih</option>
												<option value="all">all</option>
												<?php
												$list = $this->db->get_where('tbl_kelas', ['kelas_id <' => '16'])->result_array();
												foreach ($list as $x) {
													echo "<option value='" . $x['kelas_id'] . "'>" . $x['kelas_nama'] . "</option>";
												}
												?>
											</select>
										</div>
										<div class="col-md-2" style="float: right;">
											<a style="float: right;" href="<?= site_url('tagihan') ?>" class="btn btn-success">Daftar Tagihan</a>
										</div>
									</div>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<div>
										<table id="table" class="table table-striped table-hover" cellspacing="0" width="100%">
											<thead>
												<tr>
													<th>No</th>
													<th>NIS</th>
													<th>Nama Siswa</th>
													<th>Kelas</th>
													<th>Email</th>
													<th>No. Telepon</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tbody id="data_siswa">
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- /.box -->
						</div>
						<!-- /.col -->
					</div>
				</div>
				<!-- /.row -->
			</section>
		</div>
		<!-- /.content -->

		<div class="modal fade" id="modaleditkeuangan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<label id="nama"></label>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
					</div>
					<form class="form-horizontal" id="form_keuangan" action="<?php echo base_url() . 'keuangan/edit_keuangan_submit' ?>" method="post" enctype="multipart/form-data" autocomplete="off">
						<div class="modal-body">

							<input type="hidden" name="xnis" id="val_nis" class="form-control">

							<div class="form-group">
								<div class="col-md-12">
									<?php $list = $this->db->get_where('tbl_tagihan', ['sts_tagihan' => '0'])->result_array(); ?>
									<label class="form-label col-md-3">Jenis Tagihan</label>
									<div class="col-md-8">
										<select class="form-control" name="jns_tagihan" id="jns_tagihan">
											<option selected="true" disabled="true">-- Pilih --</option>
											<?php foreach ($list as $li) {
												echo "<option value='" . $li['id_tagihan'] . "'>" . $li['jns_tagihan'] . "</option>";
											} ?>
										</select>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-12">
									<label class="form-label col-md-3">Nominal Tagihan</label>
									<div class="col-md-4">
										<input type="text" name="nom_tagihan" id="nom_tagihan" class="form-control">
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-12">
									<label class="form-label col-md-3">Tgl. Jatuh Tempo</label>
									<div class="col-md-4">
										<div class="input-group date">
											<input type="text" class="form-control" name="tgl_tempo" id="tgl_tempo" placeholder="yyyy-mm-dd" required>
											<div class="input-group-addon">
												<span class="fa fa-fw fa-calendar"></span>
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary btn-flat" id="simpan">Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="modal fade" id="modaleditpembayaran" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-md" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<label id="namapembayaran"></label>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><span class="fa fa-close"></span></span></button>
					</div>
					<!-- <form class="form-horizontal" id="form_keuangan" action="<?php echo base_url() . 'keuangan/edit_pembayaran_submit' ?>" method="post" enctype="multipart/form-data"> -->
					<div class="modal-body">

						<input type="hidden" name="xnis" id="val_nis_pembayaran" class="form-control">
						<table class="table">
							<thead>
								<tr>
									<th>Jenis Tagihan</th>
									<th>Nominal</th>
									<!-- <th>Jenis Pembayaran</th> -->
									<th>Sisa Anguran</th>
									<th>Pembayaran</th>
									<th>Tgl.Pembayaran</th>
									<!-- <th>Status</th> -->
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody id="data_tagihan">
							</tbody>
						</table>

					</div>
					<!-- </form> -->
				</div>
			</div>
		</div>


		<!-- /.content-wrapper -->
		<footer class="main-footer">
			<div class="pull-right hidden-xs">
				<b>Version</b> 1.0
			</div>
			<strong>Copyright &copy; 2020 <a href="#">PKBM Anak Panah</a>.</strong> All rights reserved.
		</footer>
	</div>
	<!-- ./wrapper -->

	<!-- jQuery 2.2.3 -->
	<script src="<?php echo base_url() . 'assets/plugins/jQuery/jquery-2.2.3.min.js' ?>"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="<?php echo base_url() . 'assets/bootstrap/js/bootstrap.min.js' ?>"></script>
	<!-- DataTables -->
	<script src="<?php echo base_url() . 'assets/plugins/datatables/jquery.dataTables.min.js' ?>"></script>
	<script src="<?php echo base_url() . 'assets/plugins/datatables/dataTables.bootstrap.min.js' ?>"></script>
	<!-- SlimScroll -->
	<script src="<?php echo base_url() . 'assets/plugins/slimScroll/jquery.slimscroll.min.js' ?>"></script>
	<!-- FastClick -->
	<script src="<?php echo base_url() . 'assets/plugins/fastclick/fastclick.js' ?>"></script>
	<!-- JS Datepicker -->
	<script src="<?= base_url('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') ?>"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url() . 'assets/dist/js/app.min.js' ?>"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="<?php echo base_url() . 'assets/dist/js/demo.js' ?>"></script>
	<script type="text/javascript" src="<?php echo base_url() . 'assets/plugins/toast/jquery.toast.min.js' ?>"></script>
	<!-- page script -->
	<script>
		$(document).ready(function() {
			$("delete_siswa").click(function() {
				alert("The paragraph was clicked.");
			});
		});
		$('#closedatatable').click(function() {
			alert("The paragraph was clicked.");
		});
		$('.clickMe').click(function() {
			alert(this.id);
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function() {
			var table;
			var n_bayar = 0;
			j_bayar = 'Tunai';

			table = $('#table').DataTable({
				'processing': true,
				'serverSide': true,
				'order': [],
				'ajax': {
					'url': "<?= site_url('keuangan/list_siswa') ?>",
					'type': "POST"
				},
				'columnDefs': [{
					'targets': [0, -1],
					'orderable': false
				}]
			});

			$('#modaleditkeuangan').on('hidden.bs.modal', function() {
				$('#form_keuangan')[0].reset();
			});

			$('#kategori').change(function() {
				if (!!$(this).val()) {
					table.column(2).search($(this).val()).draw();
				} else {
					table.column(2).search($(this).val()).draw();
				}
			});

			$('#jns_tagihan').change(function() {
				$.ajax({
					url: "<?= site_url('keuangan/nominal') ?>" + "/" + $(this).val(),
					dataType: "JSON",
					type: "GET",
					success: function(hasil) {
						$('#nom_tagihan').val(new Intl.NumberFormat().format(hasil.nom_tagihan));
					}
				});
			});

			$('.input-group.date').datepicker({
				format: 'yyyy-mm-dd',
				autoclose: true,
				todayHighlight: true
				// beforeShow: function() {
				//       $(this).datepicker('option', 'maxDate', $('.input-group.date').val());
				//     }

			});

		});

		function reload_table() {
			table.ajax.reload(null, false);
		}

		function edit_pembayaran(id) {
			$.ajax({
				url: "<?= site_url('keuangan/edit_pembayaran') ?>" + "/" + id,
				type: "GET",
				dataType: "JSON",
				success: function(data) {

					$('#modaleditpembayaran').modal('show');
					$('#namapembayaran').text('List Tagihan ( ' + data[0].siswa_nama + ' )');

					var html = '';
					for (var i = 0; i < data.length; i++) {
						var select = '';
						sisa_angsur = data[i].nom_tagihan;
						sisa_pembayaran = data[i].sisa_angsur;
						html += '<tr>';
						html += '<td>' + data[i].jns_tagihan + '</td>';
						html += '<td>' + new Intl.NumberFormat().format(data[i].total_tagihan) + '</td>';
						html += '<td>' + new Intl.NumberFormat().format(data[i].sisa_angsur) + '</td>';

						html += '<td class="row"><div class="only-number"><input type="text" class="form-control nom_bayar col-md-4" id="nom_bayar"  placeholder="Input Angka" ></div></td>';
						html += '<td class="row"><input type="text" class="form-control datepicker col-md-4" name="tgl_bayar" id="tgl_bayar" placeholder="yyyy-mm-dd" required></td>';
						html += '<td><span id="test" class="btn btn-success btn-sm" onclick="bayar(' + id + ', ' + data[i].id_tagihan + ')">Bayar</span></td>';
						html += '</tr>';
					}

					$('#data_tagihan').html(html);

					$('.datepicker').datepicker({
						format: 'yyyy-mm-dd',
						timeFormat: "hh:mm:ss",
						endDate: '+0d',
						autoclose: true,
						todayHighlight: true
					});

					$('.only-number').on('keydown', '.nom_bayar', function(e) {
						-1 !== $
							.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) || /65|67|86|88/
							.test(e.keyCode) && (!0 === e.ctrlKey || !0 === e.metaKey) ||
							35 <= e.keyCode && 40 >= e.keyCode || (e.shiftKey || 48 > e.keyCode || 57 < e.keyCode) &&
							(96 > e.keyCode || 105 < e.keyCode) && e.preventDefault()
					});

					$('.only-number').on('keydown', '.nom_bayar', function(e) {
						console.log($(this).val() > Number(sisa_pembayaran))
						if ($(this).val() > Number(sisa_pembayaran) - 1 &&
							e.keyCode !== 46 &&
							e.keyCode !== 8
						) {
							e.preventDefault();
							$(this).val(Number(sisa_pembayaran));
						}
					});
				}
			});
		}

		$('#data_tagihan').on('keyup', '#nom_bayar', function() {
			n_bayar = $(this).val();
		});

		$('#data_tagihan').on('change', '#jns_bayar', function() {
			j_bayar = $(this).val();
		});

		$('#data_tagihan').on('change', '#tgl_bayar', function() {
			t_bayar = $(this).val();
		});

		function bayar(id, id_bayar) {
			$.ajax({
				url: "<?= site_url('keuangan/edit_pembayaran_submit') ?>",
				data: {
					'id': id,
					'bayar': id_bayar,
					'jns_bayar': j_bayar,
					'nom_bayar': n_bayar,
					'tgl_bayar': t_bayar
				},
				type: "POST",
				dataType: "JSON",
				success: function(data) {
					$('#modaleditpembayaran').modal('hide');

					if (data.alert) {
						alert(data.alert);
					} else {
						alert(data.respone);
					}
					$('#table').DataTable().ajax.reload();
				}
			});
		}

		function edit_keuangan(nis) {
			$.ajax({
				url: "<?= site_url('keuangan/edit_keuangan') ?>" + '/' + nis,
				type: "post",
				dataType: "json",
				success: function(data) {
					$('#modaleditkeuangan').modal('show');
					$('#nama').text('Edit Keuangan (' + data[0].siswa_nama + ')')
					$('#val_nis').val(data[0].siswa_nis);
				}
			});
		}

		function detail_keuangan(nis) {
			window.location.href = "<?= site_url('keuangan/detail_keuangan') ?>" + '/' + nis;
		}

		// function edit_pembayaran(nis){
		//   $.ajax({
		//     url: "<?= site_url('keuangan/edit_pembayaran') ?>"+'/'+nis,
		//     type: "post",
		//     dataType: "json",
		//     success: function(data){
		//       $('#modaleditpembayaran').modal('show');
		//       $('#namapembayaran').text('List Tagihan ('+data[0].siswa_nama+')')
		//       $('#val_nis_pembayaran').val(data[0].siswa_nis);
		//     }
		//   });
		// }
	</script>

	<script>
		$(function() {
			$("#example1").DataTable();
			$('#example2').DataTable({
				"paging": true,
				"lengthChange": false,
				"searching": false,
				"ordering": true,
				"info": true,
				"autoWidth": false
			});
		});
	</script>
	<?php if ($this->session->flashdata('msg') == 'error') : ?>
		<script type="text/javascript">
			$.toast({
				heading: 'Error',
				text: "Password dan Ulangi Password yang Anda masukan tidak sama.",
				showHideTransition: 'slide',
				icon: 'error',
				hideAfter: false,
				position: 'bottom-right',
				bgColor: '#FF4859'
			});
		</script>

	<?php elseif ($this->session->flashdata('msg') == 'success') : ?>
		<script type="text/javascript">
			$.toast({
				heading: 'Success',
				text: "Siswa Berhasil disimpan ke database.",
				showHideTransition: 'slide',
				icon: 'success',
				hideAfter: false,
				position: 'bottom-right',
				bgColor: '#7EC857'
			});
		</script>
	<?php elseif ($this->session->flashdata('msg') == 'info') : ?>
		<script type="text/javascript">
			$.toast({
				heading: 'Info',
				text: "Siswa berhasil di update",
				showHideTransition: 'slide',
				icon: 'info',
				hideAfter: false,
				position: 'bottom-right',
				bgColor: '#00C9E6'
			});
		</script>
	<?php elseif ($this->session->flashdata('msg') == 'info_keluar') : ?>
		<script type="text/javascript">
			$.toast({
				heading: 'Info',
				text: "Siswa berhasil di keluarkan",
				showHideTransition: 'slide',
				icon: 'info',
				hideAfter: false,
				position: 'bottom-right',
				bgColor: '#00C9E6'
			});
		</script>
	<?php else : ?>

	<?php endif; ?>
</body>

</html>
