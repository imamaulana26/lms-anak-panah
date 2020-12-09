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
				<div class="offset-md-1 col-md-10 col-sm">
					<!-- Index Prestasi -->
					<div class="card card-primary card-outline">
						<div class="card-header">
							<h5 class="card-title m-0"><i class="fas fa-fw fa-file-invoice fa-lg" style="padding-right: 1.5em"></i> Informasi Tagihan</h5>
							<a href="#" class="m-auto" style="float: right; position: relative;">View All</a>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col">
									<table class="table table-bordered" style="white-space: nowrap;">
										<thead>
											<tr>
												<th>#</th>
												<th>Jenis Tagihan</th>
												<th>Jatuh Tempo</th>
												<th>Nominal</th>
												<th>Sisa Tagihan</th>
											</tr>
										</thead>
										<tbody>
											<?php $no = 1;
											$tagihan = $this->db->select('*')->from('tbl_pembayaran a')->join('tbl_tagihan b', 'a.jns_tagihan = b.id_tagihan', 'inner')
												->where('a.nis_siswa', $this->session->userdata('username'))->get();
											if ($tagihan->num_rows() > 0) {
												foreach ($tagihan->result_array() as $tgh) { ?>
													<tr>
														<td><?= $no++ ?></td>
														<td><?= $tgh['jns_tagihan'] ?></td>
														<td><?= date('d F Y', strtotime($tgh['tgl_jatuh_tempo'])) ?></td>
														<td>Rp. <?= number_format($tgh['nom_tagihan'], 2, ',', '.') ?></td>
														<td>Rp. <?= number_format(rand(100000, 1000000), 2, ',', '.') ?></td>
													</tr>
												<?php }
											} else { ?>
												<tr>
													<td class="text-center" colspan="5">Data tidak tersedia!</td>
												</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div><!-- /.col -->
			</div><!-- /.row -->

			<div class="row">
				<div class="offset-md-1 col-md-10 col-sm">
					<!-- Index Prestasi -->
					<div class="card card-primary card-outline">
						<div class="card-header">
							<h5 class="card-title m-0"><i class="far fa-fw fa-chart-bar fa-lg" style="padding-right: 1.5em"></i> Index Prestasi</h5>
							<!-- <a href="#" class="m-auto" style="float: right; position: relative;">View All</a> -->
						</div>
						<div class="card-body">
							<form action="" method="post">
								<div class="row">
									<div class="form-group col-md-4">
										<select name="xta" class="form-control">
											<option value="" selected disabled>-- pilih tahun ajaran --</option>
											<?php
											$ta = $this->db->select('ta')->from('tbl_nilai')->where('nis_siswa', $_SESSION['username'])->group_by('ta')->get()->result_array();
											foreach ($ta as $st) {
												echo "<option value=" . $st['ta'] . ">" . $st['ta'] . "</option>";
											} ?>
										</select>
									</div>
									<div class="col-2">
										<button type="submit" class="btn btn-default"><i class="fa fa-fw fa-search"></i> Search</button>
									</div>
								</div>
							</form>
							<div class="row">
								<?php
								$cond = !isset($_POST['xta']) ? $ta[count($ta) - 1]['ta'] : $_POST['xta'];
								$sql = "select b.nm_mapel as label, a.semester, a.nilai as y from tbl_nilai a left join tbl_mapel b on a.kd_mapel = b.kd_mapel where a.nis_siswa = '" . $_SESSION['username'] . "' and a.ta = '" . $cond . "' ";
								$where_1 = " and a.semester = 1 group by label";
								$where_2 = " and a.semester = 2 group by label";

								$sms_1 = $this->db->query($sql . $where_1)->result_array();
								$sms_2 = $this->db->query($sql . $where_2)->result_array();

								$res = $this->db->query($sql . $where_1 . ' union ' . $sql . $where_2)->result_array();
								$mapel = array_unique(array_column($res, 'label'));
								// var_dump($mapel);

								$label = '[';
								foreach ($mapel as $key => $val) {
									$label .= "'" . $val . "',";
								}
								$label .= ']';

								$nilai_1 = '[';
								$color_1 = '[';
								foreach ($sms_1 as $key => $val) {
									if ($mapel[$key] == $val['label']) {
										$nilai_1 .= $val['y'] . ",";
									} else {
										$nilai_1 .= "0,";
									}
									$color_1 .= "'rgba(54, 162, 235, 0.2)',";
								}
								$color_1 .= ']';
								$nilai_1 .= ']';

								$nilai_2 = '[';
								$color_2 = '[';
								foreach ($sms_2 as $key => $val) {
									if ($mapel[$key] == $val['label']) {
										$nilai_2 .= $val['y'] . ",";
									} else {
										$nilai_2 .= "0,";
									}
									$color_2 .= "'rgba(255, 206, 86, 0.2)',";
								}
								$color_2 .= ']';
								$nilai_2 .= ']';

								?>
								<div class="col-md">
									<h3 class="text-center">Nilai tahun ajaran <?= $cond; ?></h3>
									<canvas id="myChart" style="height: 15px;"></canvas>
								</div>
							</div>
						</div>
					</div>
				</div><!-- /.col -->
			</div><!-- /.row -->

			<div class="row">
				<div class="offset-md-1 col-md-10 col-sm">
					<!-- Course -->
					<div class="card card-primary card-outline">
						<div class="card-header">
							<h5 class="card-title m-0">Penilaian</h5>
							<!-- <a href="<?= site_url('course') ?>" class="m-auto" style="float: right; position: relative;">View All</a> -->
						</div>
						<div class="card-body">
							<div class="row display">
								<?php foreach ($course as $key => $val) : ?>
									<div class="col-md-4 col-sm">
										<div class="card card-primary bg-light mb-3">
											<div class="card-header"><?= $val['mapel']; ?></div>
											<div class="card-body">
												<table class="table">
													<thead>
														<tr>
															<th>Petemuan</th>
															<th>Nilai</th>
														</tr>
													</thead>
													<tbody>
														<?php if (array_key_exists('forum', $val['item'])) : ?>
															<?php for ($i = 0; $i < count($val['item']['forum']); $i++) : ?>
																<tr>
																	<td>Forum ke-<?= $val['item']['forum'][$i]['pertemuan'] ?></td>
																	<td><?= $val['item']['forum'][$i]['nilai'] ?> point</td>
																</tr>
															<?php endfor; ?>
														<?php endif; ?>

														<?php if (array_key_exists('tugas', $val['item'])) : ?>
															<?php for ($i = 0; $i < count($val['item']['tugas']); $i++) : ?>
																<tr>
																	<td>Tugas ke-<?= $val['item']['tugas'][$i]['pertemuan'] ?></td>
																	<td><?= $val['item']['tugas'][$i]['nilai'] ?> point</td>
																</tr>
															<?php endfor; ?>
														<?php endif; ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div><!-- ./col -->
			</div><!-- ./row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content -->

	<?php // $this->load->view('siswa/v_schedule'); 
	?>
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('siswa/layout/v_js'); ?>

<!-- chart dummy -->
<script>
	var ctx = document.getElementById('myChart').getContext('2d');
	var myChart = new Chart(ctx, {
		type: 'horizontalBar',
		data: {
			labels: <?= $label; ?>,
			datasets: [{
					label: 'Semester 1',
					data: <?= $nilai_1; ?>,
					backgroundColor: <?= $color_1; ?>,
					borderColor: <?= $color_1; ?>,
					borderWidth: 1
				},
				{
					label: 'Semester 2',
					data: <?= $nilai_2; ?>,
					backgroundColor: <?= $color_2; ?>,
					borderColor: <?= $color_2; ?>,
					borderWidth: 1
				}
			]
		},
		options: {
			scales: {
				// yAxes: [{
				// 	ticks: {
				// 		beginAtZero: true
				// 	}
				// }],
				xAxes: [{
					ticks: {
						autoSkip: false,
						beginAtZero: true,
						stepSize: 20,
						callback: function(label, index, labels) {
							if (/\s/.test(label)) {
								return label.split(" ");
							} else {
								return label;
							}
						}
					}
				}]
			}
		}
	});
</script>

<script>
	(function blink() {
		$('.blink_me').fadeOut(500).fadeIn(500, blink);
	})();
</script>
