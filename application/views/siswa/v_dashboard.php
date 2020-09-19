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
							<h5 class="card-title m-0"><i class="fas fa-fw fa-file-invoice fa-lg" style="padding-right: 1.5em"></i> Informasi Tagihan</h5>
							<a href="#" class="m-auto" style="float: right; position: relative;">View All</a>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-sm">
									<table class="table">
										<thead>
											<tr>
												<th scope="col">#</th>
												<th scope="col">Jenis Tagihan</th>
												<th scope="col">Tgl. Jatuh Tempo</th>
												<th scope="col">Nominal</th>
												<th scope="col">Sisa Tagihan</th>
											</tr>
										</thead>
										<tbody>
											<?php $no = 1;
											$tagihan = $this->db->select('*')->from('tbl_pembayaran a')->join('tbl_tagihan b', 'a.jns_tagihan = b.id_tagihan', 'inner')
											->where('a.nis_siswa', $this->session->userdata('username'))->get()->result_array();
											foreach ($tagihan as $tgh) { ?>
												<tr>
													<td><?= $no++ ?></td>
													<td><?= $tgh['jns_tagihan'] ?></td>
													<td><?= date('d F Y', strtotime($tgh['tgl_jatuh_tempo'])) ?></td>
													<td>Rp. <?= number_format($tgh['nom_tagihan'], 2, ',', '.') ?></td>
													<td>Rp. <?= number_format(rand(100000, 1000000), 2, ',', '.') ?></td>
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
				<div class="offset-1 col-sm-10">
					<!-- Index Prestasi -->
					<div class="card card-primary card-outline">
						<div class="card-header">
							<h5 class="card-title m-0"><i class="far fa-fw fa-chart-bar fa-lg" style="padding-right: 1.5em"></i> Index Prestasi</h5>
							<a href="#" class="m-auto" style="float: right; position: relative;">View All</a>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="offset-1 col-sm-10">
									<canvas id="myChart" style="height: 15px;"></canvas>
								</div>
							</div>
						</div>
					</div>
				</div><!-- /.col -->
			</div><!-- /.row -->

			<div class="row">
				<div class="offset-1 col-sm-10">
					<!-- Course -->
					<div class="card card-primary card-outline">
						<div class="card-header">
							<h5 class="card-title m-0">Recent Course</h5>
							<a href="<?= site_url('course') ?>" class="m-auto" style="float: right; position: relative;">View All</a>
						</div>
						<div class="card-body">
							<div class="row">
								<?php $user = $this->session->userdata('username');

								$log = $this->db->get_where('tbl_log_forum', ['nisn_siswa' => $user])->result_array();
								$dt_user = $this->db->get_where('tbl_siswa', ['siswa_nis' => $user])->row_array();

								foreach ($log as $log) {
									$exp_forum = explode('::', $log['log_forum']);
									$n_forum = $exp_forum[0] == '' ? 0 : count($exp_forum);

									$exp_tugas = explode('::', $log['log_tugas']);
									$n_tugas = $exp_tugas[0] == '' ? 0 : count($exp_tugas);

									$li_materi = $this->db->select('a.id_pelajaran, b.nm_mapel')
									->from('tbl_pelajaran a')
									->join('tbl_mapel b', 'a.kd_mapel = b.kd_mapel', 'left')
									->where(['a.id_kelas' => $dt_user['siswa_kelas_id'], 'a.id_pelajaran' => $log['id_forum']])
									->group_by('a.id_pelajaran')->get()->result_array();

									foreach ($li_materi as $li) : ?>
										<div class="col-sm-4">
											<div class="card">
												<div class="card-img-caption">
													<img class="card-img-top" src="<?= base_url('assets/front-end/dist/img/gradient.jpg') ?>">
													<strong class="card-text" id="title"><?= $li['nm_mapel']; ?></strong>
													<p>OS1 - 1721 - ISYS6304 - THBA</p>
												</div>
												<div class="card-body">
													<?php $jml_forum = $this->db->get_where('tbl_materi_forum', ['id_forum' => $li['id_pelajaran']])->num_rows(); ?>
													<a href="<?= site_url('forum/') . $li['id_pelajaran'] ?>" id="forum"><i class="fas fa-fw fa-comments pr-1"></i> <?= $jml_forum - $n_forum ?> forum posting</a>
													<div class="dropdown-divider"></div>
													<?php $jml_tugas = $this->db->get_where('tbl_materi_tugas', ['id_forum' => $li['id_pelajaran']])->num_rows(); ?>
													<a href="<?= site_url('tugas/') . $li['id_pelajaran'] ?>"><i class="fas fa-fw fa-tasks pr-1"></i> <?= $jml_tugas - $n_tugas ?> Assigment to do</a>
													<div class="dropdown-divider"></div>
													<a href="javascript:void(0)" id="view" data-toggle="modal" data-target="#modal_schedule"><i class="fas fa-fw fa-clipboard-list pr-1"></i> View schedule</a>
												</div>
											</div>
										</div>
									<?php endforeach;
								} ?>
							</div>
						</div>
					</div>
				</div><!-- ./col -->
			</div><!-- ./row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content -->

	<?php $this->load->view('siswa/v_schedule'); ?>
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
