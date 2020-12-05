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
							<a href="#" class="m-auto" style="float: right; position: relative;">View All</a>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="offset-md-1 col-md-10 col-sm">
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
		type: 'bar',
		data: {
			labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
			datasets: [{
				label: '# of Votes',
				data: [12, 19, 3, 5, 2, 3],
				backgroundColor: [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 206, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(153, 102, 255, 0.2)',
					'rgba(255, 159, 64, 0.2)'
				],
				borderColor: [
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 206, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)'
				],
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true
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
