<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container">
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<div class="content">
		<div class="container">
			<!-- Announcement -->
			<?php $notif = $this->db->get('tbl_pengumuman')->row_array();
			if ($notif['aktifkan'] > 0) { ?>
				<div class="row">
					<div class="offset-1 col-sm-10">
						<div class="alert alert-info" role="alert">
							<h4 class="alert-heading">Announcement!</h4>
							<p><?= $notif['pengumuman_deskripsi'] ?></p>
							<hr>
							<p class="mb-0">&copy; Anak Panah Cyber Scholl.</p>
						</div>
					</div>
				</div>
			<?php } ?>

			<!-- Tagihan -->
			<div class="row">
				<div class="offset-1 col-sm-10">
					<!-- Index Prestasi -->
					<div class="card card-primary card-outline">
						<div class="card-header">
							<h5 class="card-title m-0"><i class="fas fa-fw fa-info-circle fa-lg"></i> Notifikasi</h5>
						</div>
						<div class="card-body">
							<table class="table table-bordered table-hover" id="example1">
								<thead>
									<tr>
										<th style="width: 20px;">#</th>
										<th style="display: none;">id</th>
										<th>Daftar Notifikasi</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($komen->result_array() as $res) :
										// var_dump($res);
										$diff = date_diff(date_create($res['createDate']), date_create(date('Y-m-d H:i:s')));
										if ($diff->y > 0) {
											$date = date_format(date_create($res['createDate']), 'd/m/y');
										} elseif ($diff->m > 1 || $diff->d > 1) {
											$date = date_format(date_create($res['createDate']), 'd M');
										} else {
											$date = date_format(date_create($res['createDate']), 'H:i');
										}

										$exp = explode(' ', $res['isi_komen']);
										$msg = '';
										for ($i = 0; $i < count($exp); $i++) {
											if ($i >= 10) break;
											else $msg .= $exp[$i] . ' ';
										} ?>
										<tr style="cursor: pointer">
											<td><?= $no++ ?></td>
											<td style="display: none;"><?= $res['id_forum'] ?></td>
											<td id="read<?= $res['id_forum'] ?>">
												From : <b><?= $res['pengguna_nama'] ?></b><span style="position: relative; float: right; top: 0;"><?= $date ?></span>
												<hr>
												<p class="mb-3s">
													Telah berkomentar pada forum <b><?= $res['judul_materi']; ?></b>
												</p>
												<?= $msg ?>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div><!-- /.col -->
		</div><!-- /.row -->

	</div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<?php $this->load->view('siswa/v_schedule'); ?>
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('siswa/layout/v_js'); ?>

<script>
	var table = $("#example1").DataTable({
		'ordering': false
	});

	$('#example1 tbody').on('click', 'tr', function() {
		var id = table.row(this).data()[1];

		$(location).attr('href', '<?= site_url('forum/') ?>' + id);
	});
</script>
