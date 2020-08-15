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
			<!-- pemberitahuan -->
			<div class="row">
				<div class="offset-1 col-sm-10">
					<div class="card card-primary card-outline">
						<div class="card-header">
							<h5 class="card-title m-0">Pemberitahuan</h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-sm">
									<?php $data = $this->db->select('siswa_nama,isi_komen,judul_materi,nm_mapel,c.id_forum,c.pertemuan,b.reply_to')->from('tbl_siswa a')->join('tbl_komentar b', 'b.user_komen = a.siswa_nis')->join('tbl_materi c', 'b.pertemuan = c.pertemuan')->join('tbl_pelajaran d', ' b.id_forum = d.id_pelajaran')->join('tbl_mapel e', ' d.kd_mapel = e.kd_mapel')->where('b.mention','2019638')->get()->result_array();
									?>
									<table class="table table-striped">
										<thead>
											<tr>
												<th scope="col">#</th>
												<th scope="col">Nama</th>
												<th scope="col">Komentar</th>
												<th scope="col">di forum</th>
												<th scope="col">Judul Materi</th>
												<th scope="col">action</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($data as $key) {?>
												<tr>
													<th scope="row">1</th>
													<td><?= $key['siswa_nama']  ?></td>
													<td><?= $key['isi_komen']  ?></td>
													<td><?= $key['nm_mapel']  ?></td>
													<td><?= $key['judul_materi']  ?></td>
													<td>
														<form method="post" action="<?= site_url('forum/balas_komen') ?>">
															<input type="hidden" name="idforum" value="<?= $key['id_forum'] ?>">
															<input type="hidden" name="pertemuan" value="<?= $key['pertemuan'] ?>">
															<input type="hidden" name="idmention" value="<?= $key['reply_to'] ?>">
															<button type="submit" class="btn btn-primary">Submit</button>
														</form>
													</td>
												</tr>
											<?php  } ?>
										</tbody>
									</table>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /.row -->
			<!-- end of pemberitahuan -->

			<!-- Next Agenda -->
			<!-- <div class="row">
                <div class="offset-1 col-sm-10">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="card-title m-0">Next Agenda</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="card" style="height: 21%">
                                        <div class="card-header">
                                            <i class="fas fa-fw fa-video mr-1"></i> Video Conference
                                        </div>
                                        <div class="m-3">
                                            <p class="card-text"><i class="fas fa-fw fa-bookmark mr-1"></i> Business Application Development</p>
                                            <p class="card-text"><i class="far fa-fw fa-calendar-alt mr-1"></i> <?= date('d M Y'); ?></p>
                                            <p class="card-text"><i class="far fa-fw fa-clock mr-1"></i> 19:20 - 20:10</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card" style="height: 21%">
                                        <div class="card-header">
                                            <i class="fas fa-fw fa-video mr-1"></i> Video Conference
                                        </div>
                                        <div class="m-3">
                                            <p class="card-text"><i class="fas fa-fw fa-bookmark mr-1"></i> UI / UX Designer</p>
                                            <p class="card-text"><i class="far fa-fw fa-calendar-alt mr-1"></i> <?= date('d M Y'); ?></p>
                                            <p class="card-text"><i class="far fa-fw fa-clock mr-1"></i> 19:20 - 20:10</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card" style="height: 21%">
                                        <div class="card-header">
                                            <i class="far fa-fw fa-file-alt mr-1"></i> Onsite Class Meeting
                                        </div>
                                        <div class="m-3">
                                            <p class="card-text"><i class="fas fa-fw fa-bookmark mr-1"></i> Information System Project Management</p>
                                            <p class="card-text"><i class="far fa-fw fa-calendar-alt mr-1"></i> <?= date('d M Y'); ?></p>
                                            <p class="card-text"><i class="far fa-fw fa-clock mr-1"></i> 19:20 - 20:10</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- /.row -->

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
            						$exp = explode('::', $log['log_forum']);
            						$count = $exp[0] == '' ? 0 : count($exp);

            						$li_materi = $this->db->select('a.id_forum, c.nm_mapel, (count(a.id_forum) - ' . $count . ') as jml_forum')
            						->from('tbl_materi a')
            						->join('tbl_pelajaran b', 'a.id_forum = b.id_pelajaran', 'left')
            						->join('tbl_mapel c', 'b.kd_mapel = c.kd_mapel', 'left')
            						->where(['b.id_kelas' => $dt_user['siswa_kelas_id'], 'a.id_forum' => $log['id_forum']])
            						->group_by('a.id_forum')->get()->result_array();

            						foreach ($li_materi as $li) :
            							if ($li['jml_forum'] > 0) : ?>
            								<div class="col-sm-4">
            									<div class="card">
            										<div class="card-img-caption">
            											<img class="card-img-top" src="<?= base_url('assets/front-end/dist/img/gradient.jpg') ?>">
            											<strong class="card-text" id="title"><?= $li['nm_mapel']; ?></strong>
            											<p>OS1 - 1721 - ISYS6304 - THBA</p>
            										</div>
            										<div class="card-body">
            											<a href="<?= site_url('forum/') . $li['id_forum'] ?>" id="forum"><i class="fas fa-fw fa-comments pr-1"></i> <?= $li['jml_forum'] ?> forum posting</a>
            											<div class="dropdown-divider"></div>
            											<a href="#"><i class="fas fa-fw fa-tasks pr-1"></i> <?= rand(1, 10) ?> Assigment to do</a>
            											<div class="dropdown-divider"></div>
            											<a href="javascript:void(0)" id="view" data-toggle="modal" data-target="#modal_schedule"><i class="fas fa-fw fa-clipboard-list pr-1"></i> View schedule</a>
            										</div>
            									</div>
            								</div>
            							<?php endif;
            						endforeach;
            					} ?>
								<!-- <div class="col-sm-4">
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
								</div> -->
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
