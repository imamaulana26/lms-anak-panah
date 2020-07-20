<style>
	/*  Bhoechie tab */
	div.bhoechie-tab-container {
		background-color: #ffffff;
		padding: 0;
		border: 1px solid #ddd;

	}

	div.bhoechie-tab-menu {
		padding-right: 0;
		padding-left: 0;
		padding-bottom: 0;
	}

	div.bhoechie-tab-menu div.list-group {
		margin-bottom: 0;
	}

	div.bhoechie-tab-menu div.list-group>a {
		margin-bottom: 0;
	}

	div.bhoechie-tab-menu div.list-group>a .glyphicon,
	div.bhoechie-tab-menu div.list-group>a .fa {
		color: #428bca;
	}

	div.bhoechie-tab-menu div.list-group>a {
		border-right: 1px solid #ddd;
		border-left: 0;
		border-top: 0;
	}

	div.bhoechie-tab-menu div.list-group>a:last-child {
		border-bottom: 0;
	}

	div.bhoechie-tab-menu div.list-group>a.active,
	div.bhoechie-tab-menu div.list-group>a.active .glyphicon,
	div.bhoechie-tab-menu div.list-group>a.active .fa {
		background-color: #428bca;
		background-image: #428bca;
		color: #ffffff;
		border-bottom: 0;
		border-right: 1px solid #428bca;
	}

	div.bhoechie-tab-menu div.list-group>a.active:after {
		content: '';
		position: absolute;
		left: 100%;
		top: 50%;
		margin-top: -13px;
		border-left: 0;
		border-bottom: 13px solid transparent;
		border-top: 13px solid transparent;
		border-left: 10px solid #428bca;
	}

	div.bhoechie-tab-content {
		background-color: #ffffff;
		padding-left: 20px;
		padding-top: 10px;
	}

	div.bhoechie-tab div.bhoechie-tab-content:not(.active) {
		display: none;
	}

	/* .list-group-item {
		border: 1px solid #ccc !important;
	} */

	.card-primary {
		border-radius: 5px 5px 5px 5px;
		-moz-border-radius: 5px 5px 5px 5px;
		-webkit-border-radius: 5px 5px 5px 5px;
		border: 0px solid #000000;
	}
</style>

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
			<div class="row">
				<div class="offset-1 col-sm-10">
					<?php if (!empty($materi)) : ?>
						<h2 class="pb-3">Forum <?= $forum['nm_mapel'] ?></h2>
						<!-- <div class="card card-outline">
							<div class="card-primary card-body row bhoechie-tab-container">
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu">
								<div class="list-group nav flex-column nav-pills">
									<?php $arr = array(1 => 'Pertama', 2 => 'Kedua', 3 => 'Ketiga', 4 => 'Keempat');
									foreach ($arr as $key => $val) : ?>
										<a href="#week-<?= $key ?>" class="nav-link list-group-item <?= $key == 1 ? 'active' : '' ?>" id="week-<?= $key ?>-tab" aria-controls="week-<?= $key ?>" data-toggle="pill" role="tab">
											<h5>Minggu <?= $val ?></h5>
											<small><?= date('d M Y', strtotime('2020-' . rand(1, 12) . '-' . rand(1, 31))) ?></small>
											<p>Overview Part <?= $key ?> (<?= $key % 2 == 0 ? 'Pratek' : 'Teori' ?>)</p>
										</a>
									<?php endforeach; ?>
								</div>
							</div>
							<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
								<?php foreach ($arr as $key => $val) : ?>
									<div class="bhoechie-tab-content tab-pane fade <?= $key == 1 ? 'show active' : '' ?>" id="week-<?= $key ?>" role="tabpanel" aria-labelledby="week-<?= $key ?>-tab">
										<div class="card-header">
											<label>Minggu <?= $val ?> (<?= $key % 2 == 0 ? 'Pratek' : 'Teori' ?>)</label>
											<span class="float-right">
												<a href=""><i class="fa fa-fw fa-comments ml-3"></i></a>
												<a href=""><i class="fa fa-fw fa-tasks ml-3"></i></a>
											</span>
										</div>
										<div class="card-body">
											<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque at, ullam excepturi eligendi necessitatibus assumenda ad dolores quasi ducimus! Sequi, nemo ut quia aperiam magni quam id quod autem pariatur.</p>
											<?php if ($key % 2 != 0) : ?>
												<hr>
												<span data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="cursor: pointer;">
													Lihat Komentar (<?= rand(1, 100) ?>)
												</span>

												<div class="collapse" id="collapseExample">
													Main Comments
													<div class="card-body px-0">
														<div class="row">
															<?php for ($i = 1; $i <= 3; $i++) :
																if ($i % 2 == 0) $komen = true;
																else $komen = false; ?>
																<div class="card-header d-flex">
																	<div class="col-md-1">
																		<img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid" />
																	</div>
																	<div class="col-md">
																		<strong class="float-left">Jhony</strong>
																		<small class="float-right text-secondary"><?= rand(1, 59) ?> Minutes Ago</small>
																		<div class="clearfix"></div>
																	</div>
																</div>
																<div class="card-body pb-0">
																	<p>Lorem Ipsum is simply dummy text of the pr make but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
																	<span>
																		<a class="float-right btn btn-sm btn-link"> <i class="fa fa-fw fa-reply"></i> Reply</a>
																		<span data-toggle="collapse" data-target="#comments-<?= $i ?>" aria-expanded="false" aria-controls="comments" style="cursor: pointer;">
																			<i class="fa fa-fw fa-comments"></i> Komentar <?= $i % 2 != 0 ? '(' . rand(0, 50) . ')' : '' ?>
																		</span>
																	</span>
																</div>

																<?php if ($komen == false) : ?>
																	Reply Main Comments
																	<div class="collapse" id="comments-<?= $i ?>">
																		<div class="col-lg ml-3">
																			<div class="card-header d-flex">
																				<div class="col-md-1">
																					<img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid" />
																				</div>
																				<div class="col-md">
																					<strong class="float-left">Akash</strong>
																					<small class="float-right text-secondary"><?= rand(1, 59) ?> Minutes Ago</small>
																					<div class="clearfix"></div>
																				</div>
																			</div>
																			<div class="card-body pb-0">
																				<p>Lorem Ipsum is simply dummy text of the pr make but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
																				<span>
																					<a class="float-right btn btn-sm btn-link"> <i class="fa fa-fw fa-reply"></i> Reply</a>
																				</span>
																			</div>
																		</div>
																		<?php if ($i == 1) : ?>
																			<div class="col-lg ml-3">
																				<div class="card-header d-flex">
																					<div class="col-md-1">
																						<img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid" />
																					</div>
																					<div class="col-md">
																						<strong class="float-left">Maniruzzaman</strong>
																						<small class="float-right text-secondary"><?= rand(1, 59) ?> Minutes Ago</small>
																						<div class="clearfix"></div>
																					</div>
																				</div>
																				<div class="card-body pb-0">
																					<p><b>Akash</b> It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
																					<span>
																						<a class="float-right btn btn-sm btn-link"> <i class="fa fa-fw fa-reply"></i> Reply</a>
																					</span>
																				</div>
																			</div>
																		<?php endif; ?>
																	</div>
																	End of Reply Main Comments
																<?php endif; ?>
															<?php endfor; ?>
														</div>
														End of Main Comments
													</div>
												</div>
											<?php endif; ?>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div> -->

						<div class="card card-outline">
							<div class="card-primary card-body row bhoechie-tab-container">
								<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu">
									<div class="list-group nav flex-column nav-pills">
										<?php foreach ($materi as $val) : ?>
											<a href="#forum-<?= $val['pertemuan'] ?>" class="nav-link list-group-item <?= $val['pertemuan'] == 1 ? 'active' : '' ?>" id="forum-<?= $val['pertemuan'] ?>-tab" aria-controls="forum-<?= $val['pertemuan'] ?>" data-toggle="pill" role="tab">
												<h5>Forum Ke-<?= $val['pertemuan'] ?></h5>
												<small><?= date('d M Y', strtotime($val['createDate'])) ?></small>
												<p><?= word_limiter($val['judul_materi'], 2) ?></p>
											</a>
										<?php endforeach; ?>
									</div>
								</div>
								<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
									<?php foreach ($materi as $val) : ?>
										<div class="bhoechie-tab-content tab-pane fade <?= $val['pertemuan'] == 1 ? 'show active' : '' ?>" id="forum-<?= $val['pertemuan'] ?>" role="tabpanel" aria-labelledby="forum-<?= $val['pertemuan'] ?>-tab">
											<div class="card-header">
												<label><?= $val['judul_materi'] ?> (<?= $val['jns_materi'] ?>)</label>
												<span class="float-right">
													<a href=""><i class="fa fa-fw fa-comments ml-3"></i></a>
													<a href=""><i class="fa fa-fw fa-tasks ml-3"></i></a>
												</span>
											</div>
											<div class="card-body">
												<p><?= $val['isi_materi'] ?></p>
												<?php if ($val['jns_materi'] == 'Teori') : ?>
													<hr>
													<span data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="cursor: pointer;">
														<?php $li_komen = $this->db->get_where('tbl_komentar', ['id_forum' => $val['id_forum'], 'pertemuan' => $val['pertemuan']])->num_rows(); ?>
														Lihat Komentar (<?= $li_komen ?>)
													</span>

													<div class="collapse" id="collapseExample">
														<!-- Main Comments -->
														<div class="card-body px-0">
															<div class="row">
																<?php $komen = $this->db->get_where('tbl_komentar', ['id_forum' => $val['id_forum'], 'pertemuan' => $val['pertemuan'], 'reply_to' => 0]);
																foreach ($komen->result_array() as $cmd) :
																	$siswa = $this->db->get_where('tbl_siswa', ['siswa_nis' => $cmd['user_komen']])->row_array(); ?>
																	<div class="card-header d-flex">
																		<div class="col-md-1">
																			<img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid" />
																		</div>
																		<div class="col-md">
																			<strong class="float-left"><?= $siswa['siswa_nama'] ?></strong>
																			<small class="float-right text-secondary"><?= date('d M Y H:i', strtotime($cmd['createDate'])) ?></small>
																			<div class="clearfix"></div>
																		</div>
																	</div>
																	<div class="card-body pb-0">
																		<p><?= $cmd['isi_komen'] ?></p>
																		<span>
																			<a class="float-right btn btn-sm btn-link"> <i class="fa fa-fw fa-reply"></i> Reply</a>
																			<span data-toggle="collapse" data-target="#comments-<?= $cmd['id'] ?>" aria-expanded="false" aria-controls="comments" style="cursor: pointer;">
																				<?php $li_reply = $this->db->get_where('tbl_komentar', ['reply_to' => $cmd['id']])->num_rows(); ?>
																				<i class="fa fa-fw fa-comments"></i> Komentar (<?= $li_reply ?>)
																			</span>
																		</span>
																	</div>

																	<?php $reply = $this->db->get_where('tbl_komentar', ['id_forum' => $val['id_forum'], 'pertemuan' => $val['pertemuan'], 'reply_to' => $cmd['id']]);
																	foreach ($reply->result_array() as $rep) :
																		$rep_siswa = $this->db->get_where('tbl_siswa', ['siswa_nis' => $rep['user_komen']])->row_array();
																		$mention = $this->db->get_where('tbl_siswa', ['siswa_nis' => $rep['mention']])->row_array(); ?>
																		<!-- Reply Main Comments -->
																		<div class="collapse" id="comments-<?= $cmd['id'] ?>">
																			<div class="col-lg ml-3">
																				<div class="card-header d-flex">
																					<div class="col-md-1">
																						<img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid" />
																					</div>
																					<div class="col-md">
																						<strong class="float-left"><?= $rep_siswa['siswa_nama'] ?></strong>
																						<small class="float-right text-secondary"><?= date('d M Y H:i', strtotime($rep['createDate'])) ?></small>
																						<div class="clearfix"></div>
																					</div>
																				</div>
																				<div class="card-body pb-0">
																					<p><b><?= $mention['siswa_nama'] ?></b> <?= $rep['isi_komen'] ?></p>
																					<span>
																						<a class="float-right btn btn-sm btn-link"> <i class="fa fa-fw fa-reply"></i> Reply</a>
																					</span>
																				</div>
																			</div>
																		</div>
																		<!-- End of Reply Main Comments -->
																	<?php endforeach; ?>
																<?php endforeach; ?>
															</div>
															<!-- End of Main Comments -->
														</div>
													</div>
												<?php endif; ?>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
				</div>
			<?php else : ?>
				<h2 class="pb-3 text-center">Forum Tidak Tersedia</h2>
			<?php endif; ?>
			</div>
		</div>
	</div>
	<!-- /.container -->

</div><!-- /.content-wrapper -->

<?php $this->load->view('siswa/v_schedule') ?>
</div>

<?php $this->load->view('siswa/layout/v_js'); ?>

<script>
	$('#myTab.nav-link').on('click', function(e) {
		e.preventDefault()
		$(this).tab('show')
	})
</script>
