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
								<div class="col-sm-4">
									<div class="card">
										<div class="card-img-caption">
											<img class="card-img-top" src="<?= base_url('assets/front-end/dist/img/gradient.jpg') ?>">
											<strong class="card-text" id="title">BUSINESS APPLICATION DEVELOPMENT</strong>
											<p>OS1 - 1721 - ISYS6304 - THBA</p>
										</div>
										<div class="card-body">
											<a href="#" class="disabled"><i class="fas fa-fw fa-comments pr-1"></i> No new forum posting</a>
											<div class="dropdown-divider"></div>
											<a href="#"><i class="fas fa-fw fa-tasks pr-1"></i> <?= rand(1, 10) ?> Assigment to do</a>
											<div class="dropdown-divider"></div>
											<a href="javascript:void(0)" id="view" data-toggle="modal" data-target="#modal_schedule"><i class="fas fa-fw fa-clipboard-list pr-1"></i> View schedule</a>
										</div>
									</div>
								</div>

								<div class="col-sm-4">
									<div class="card">
										<div class="card-img-caption">
											<img class="card-img-top" src="<?= base_url('assets/front-end/dist/img/gradient.jpg') ?>">
											<strong class="card-text" id="title">UI / UX DESIGNER</strong>
											<p>OS1 - 1721 - ISYS6310 - THBA</p>
										</div>
										<div class="card-body">
											<a href="#" class="disabled"><i class="fas fa-fw fa-comments pr-1"></i> <?= rand(1, 10) ?> new forum posting</a>
											<div class="dropdown-divider"></div>
											<a href="#"><i class="fas fa-fw fa-tasks pr-1"></i> <?= rand(1, 10) ?> Assigment to do</a>
											<div class="dropdown-divider"></div>
											<a href="javascript:void(0)" id="view" data-toggle="modal" data-target="#modal_schedule"><i class="fas fa-fw fa-clipboard-list pr-1"></i> View schedule</a>
										</div>
									</div>
								</div>

								<div class="col-sm-4">
									<div class="card">
										<div class="card-img-caption">
											<img class="card-img-top" src="<?= base_url('assets/front-end/dist/img/gradient.jpg') ?>">
											<strong class="card-text" id="title">UI / UX DESIGNER</strong>
											<p>OS1 - 1721 - ISYS6310 - THBA</p>
										</div>
										<div class="card-body">
											<a href="#" class="disabled"><i class="fas fa-fw fa-comments pr-1"></i> <?= rand(1, 10) ?> new forum posting</a>
											<div class="dropdown-divider"></div>
											<a href="#"><i class="fas fa-fw fa-tasks pr-1"></i> <?= rand(1, 10) ?> Assigment to do</a>
											<div class="dropdown-divider"></div>
											<a href="javascript:void(0)" id="view" data-toggle="modal" data-target="#modal_schedule"><i class="fas fa-fw fa-clipboard-list pr-1"></i> View schedule</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div><!-- ./col -->
			</div><!-- ./row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content -->

	<?php $this->load->view('pengajar/v_schedule'); ?>
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('pengajar/layout/v_js'); ?>

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
