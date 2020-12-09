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

	/*
	.list-group-item {
		border: 1px solid #ccc !important;
	}
	*/

	.card-primary {
		border-radius: 5px 5px 5px 5px;
		-moz-border-radius: 5px 5px 5px 5px;
		-webkit-border-radius: 5px 5px 5px 5px;
		border: 0px solid #000000;
	}

	.bordered {
		border-left: 3px solid #007bff;
	}

	#cke_editorfr1 {
		width: 100%;
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
	<?php
	$akses = $this->session->userdata('akses');
	$page = (empty($this->session->flashdata('page'))) ? 1 : $this->session->flashdata('page');
	?>
	<!-- Main content -->
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="offset-1 col-sm-10">
					<a href="<?= site_url('forum/tambah_forum/' . $this->uri->segment(2)) ?>" class="btn btn-primary float-right">Buat Forum Baru</a>
					<h2 class="pb-3">Forum <?= $forum['nm_mapel'] ?></h2>

					<div class="card card-outline">
						<div class="card-primary card-body row bhoechie-tab-container">
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu">
								<div class="list-group nav flex-column nav-pills">
									<?php foreach ($materi as $val) : ?>
										<a href="#forum-<?= $val['pertemuan'] ?>" class="nav-link list-group-item <?= $val['pertemuan'] == $page ? 'active' : '' ?>" id="forum-<?= $val['pertemuan'] ?>-tab" aria-controls="forum-<?= $val['pertemuan'] ?>" data-toggle="pill" role="tab">
											<h5>
												Forum Ke-<?= $val['pertemuan'] ?>
											</h5>
											<small><?= date('d M Y', strtotime($val['createDate'])) ?></small>
											<p><?= word_limiter($val['judul_materi'], 2) ?></p>
										</a>
									<?php endforeach; ?>
								</div>
							</div>
							<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
								<?php foreach ($materi as $val) : ?>
									<div class="bhoechie-tab-content tab-pane fade <?= $val['pertemuan'] == $page ? 'show active' : '' ?>" id="forum-<?= $val['pertemuan'] ?>" role="tabpanel" aria-labelledby="forum-<?= $val['pertemuan'] ?>-tab">
										<div class="card-header">
											<label><?= $val['judul_materi'] ?> (<?= $val['jns_materi'] ?>)</label>
											<span class="float-right">
												<a href="<?= site_url('absensi_fr/') . $this->uri->segment(2) . "/" . $val['pertemuan'] ?>" class="badge badge-info">Absensi</a>
												<a href="javascript:void(0)" class="badge badge-<?= $val['status'] == 0 ? 'success' : 'danger' ?>" onclick="sts_forum('<?= $val['id'] ?>')"><?= $val['status'] == 0 ? 'Aktif' : 'Non-aktif' ?></a>
												<a href="<?= site_url('forum/edit_forum/' . $val['id']) ?>" style="color: #1e7e34;"><i class="fa fa-fw fa-pencil-alt ml-3"></i></a>
												<a href="javascript:void(0)" onclick="delete_forum('<?= $val['id'] ?>')" style="color: #dc3545;"><i class="fa fa-fw fa-times ml-3"></i></a>
											</span>
										</div>
										<div class="card-body">
											<p><?= $val['isi_materi'] ?></p>
											<?php if (!empty($val['lampiran'])) : ?>
												<?php if (is_array(unserialize($val['lampiran']))) : ?>
													<p><b>Lampiran</b></p>
													<?php foreach (unserialize($val['lampiran']) as $att) : ?>
														<a href="<?= $att ?>" data-toggle="lightbox" data-gallery="gallery-<?= $val['id'] ?>">
															<img src="<?= $att ?>" class="img-thumbnail" style="max-height: 80px; max-width: 80px;">
														</a>
													<?php endforeach; ?>
												<?php else : ?>
													<p><b>Lampiran</b></p>
													<a href="<?= unserialize($val['lampiran']) ?>" data-toggle="lightbox" data-gallery="gallery-<?= $val['id'] ?>">
														<img src="<?= unserialize($val['lampiran']) ?>" class="img-thumbnail" style="max-height: 80px; max-width: 80px;">
													</a>
												<?php endif; ?>
											<?php endif; ?>
											<hr>
											<div>
												<a class="float-right btn btn-sm" data-toggle="collapse" href="#show_komen-<?= $val['id_forum'] . '-' . $val['pertemuan'] ?>">
													<i class="fa fa-fw fa-reply"></i> Balas
												</a>
												<span data-toggle="collapse" data-target="#collapseExample-<?= $val['id'] ?>" aria-expanded="false" aria-controls="collapseExample" style="cursor: pointer;">
													<?php $li_komen = $this->db->get_where('tbl_komen_forum', ['id_forum' => $val['id_forum'], 'pertemuan' => $val['pertemuan']])->num_rows(); ?>
													Lihat Komentar (<?= $li_komen ?>)
												</span>
												<div class="collapse pt-3" id="show_komen-<?= $val['id_forum'] . '-' . $val['pertemuan'] ?>">
													<div class="card card-body">
														<form action="<?= site_url('forum/submit_main') ?>" method="post" autocomplete="off" enctype="multipart/form-data">
															<input type="hidden" name="id" id="id" value="<?= $val['id'] ?>">
															<input type="hidden" name="id_forum" id="id_forum" value="<?= $val['id_forum'] ?>">
															<input type="hidden" name="pertemuan" id="pertemuan" value="<?= $val['pertemuan'] ?>">
															<input type="hidden" name="user_komen" id="user_komen" value="<?= $this->session->userdata('user'); ?>">
															<textarea name="komentar" id="editorfr<?= $val['id'] ?>" placeholder="Type Here"></textarea>

															<div class="form-group mt-2">
																<label>Lampirkan Gambar</label>
																<div class="custom-file">
																	<input type="file" class="custom-file-input" name="gambar" id="gambar">
																	<label class="custom-file-label" for="customFile">Choose file</label>
																</div>
															</div>
															<div class="input-group-append">
																<button class="btn btn-info" type="submit"><i class="fa fa-fw fa-paper-plane"></i> Submit</button>
															</div>
														</form>
													</div>
												</div>
											</div>

											<div class="collapse <?= $this->session->flashdata('page') ? 'show' : '' ?>" id="collapseExample-<?= $val['id'] ?>">
												<!-- Main Comments -->
												<div class="card-body">
													<div class="row">
														<?php $komen = $this->db->get_where('tbl_komen_forum', ['id_forum' => $val['id_forum'], 'pertemuan' => $val['pertemuan'], 'reply_to' => 0]);
														foreach ($komen->result_array() as $cmd) :
															$siswa = $this->db->get_where('tbl_siswa', ['siswa_nis' => $cmd['user_komen']])->row_array();
															// $nilai = $this->db->get_where('tbl_nilai_onclass', ['user_siswa' => $cmd['user_komen'], 'id_pelajaran' => $val['id_forum'], 'pertemuan_ke' => $val['pertemuan'], 'tipe' => 'Forum'])->num_rows();
															$nilai = $this->db->get_where('tbl_nilai_onclass', ['user_siswa' => $cmd['user_komen'], 'id_pelajaran' => $val['id_forum'], 'pertemuan_ke' => $val['pertemuan'], 'tipe' => 'Forum'])->row_array();
															$score = empty($nilai['nilai']) ? '' : ' (' . $nilai['nilai'] . ' point)';

															$admin = $this->db->get_where('tbl_pengguna', ['pengguna_username' => $cmd['user_komen']])->row_array();
															$rep_user = empty($siswa) ? $admin['pengguna_nama'] . ' (pengajar)' : $siswa['siswa_nama'] . $score; ?>
															<div class="card-header bordered mt-3 d-flex">
																<div class="col-md-1">
																	<img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid" />
																</div>
																<div class="col-md">
																	<strong class="float-left"><?= $rep_user ?></strong>
																	<small class="float-right text-secondary">
																		<div class="dropdown mx-1">
																			<a href="#" class="btn btn-link btn-xs" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																				<i class='fa fa-ellipsis-v'></i>
																			</a>
																			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
																				<?php if ($admin['pengguna_username'] != $this->session->userdata('username')) : ?>
																					<a class="dropdown-item" href="javascript:void(0)" onclick="nilai('<?= $cmd['id'] ?>')" style="font-size: 12px; color: #007bff;">
																						<i class="fa fa-fw fa-check-square"></i> Nilai
																					</a>
																				<?php endif; ?>
																				<!-- <a class="dropdown-item" href="<?= site_url('forum/edit_komen/' . $cmd['id']) ?>" style="font-size: 12px; color: #1e7e34;">
																					<i class="fa fa-fw fa-pencil-alt"></i> Sunting
																				</a> -->
																				<a class="dropdown-item" href="javascript:void(0)" onclick="hapus_komen('<?= $cmd['id'] ?>')" style="font-size: 12px; color: #dc3545;">
																					<i class="fa fa-fw fa-times"></i> Hapus
																				</a>
																			</div>
																		</div>
																	</small>
																	<small class="float-right text-secondary">
																		<?= date('d M y', strtotime($cmd['createDate'])) ?>
																	</small>
																	<div class="clearfix"></div>
																</div>
															</div>
															<div class="card-body bordered pb-0">
																<p>
																	<?= $cmd['isi_komen'] ?>
																</p>
																<?php if (!empty($cmd['lampiran'])) : ?>
																	<?php if (is_array(unserialize($cmd['lampiran']))) : ?>
																		<p><b>Lampiran</b></p>
																		<?php foreach (unserialize($cmd['lampiran']) as $att) : ?>
																			<a href="<?= $att ?>" data-toggle="lightbox" data-gallery="gallery-<?= $cmd['id'] ?>">
																				<img src="<?= $att ?>" class="img-thumbnail mb-3" style="max-height: 80px; max-width: 80px;">
																			</a>
																		<?php endforeach; ?>
																	<?php else : ?>
																		<p><b>Lampiran</b></p>
																		<a href="<?= unserialize($cmd['lampiran']) ?>" data-toggle="lightbox" data-gallery="gallery-<?= $cmd['id'] ?>">
																			<img src="<?= unserialize($cmd['lampiran']) ?>" class="img-thumbnail mb-3" style="max-height: 80px; max-width: 80px;">
																		</a>
																	<?php endif; ?>
																<?php endif; ?>
																<div>
																	<a class="float-right btn btn-sm" data-toggle="collapse" href="#show_komen-<?= $cmd['id'] ?>">
																		<i class="fa fa-fw fa-reply"></i> Balas
																	</a>
																	<span data-toggle="collapse" data-target="#comments-<?= $cmd['id'] ?>" aria-expanded="false" aria-controls="comments" style="cursor: pointer;">
																		<?php $li_reply = $this->db->get_where('tbl_komen_forum', ['reply_to' => $cmd['id']])->num_rows(); ?>
																		<i class="fa fa-fw fa-comments"></i> Komentar (<?= $li_reply ?>)
																	</span>
																</div>
																<div class="collapse pt-3" id="show_komen-<?= $cmd['id'] ?>">
																	<div class="card card-body">
																		<form action="<?= site_url('forum/submit_komen') ?>" method="post" autocomplete="off" enctype="multipart/form-data">
																			<input type="hidden" name="id" id="id" value="<?= $val['id'] ?>">
																			<input type="hidden" name="id_forum" id="id_forum" value="<?= $cmd['id_forum'] ?>">
																			<input type="hidden" name="pertemuan" id="pertemuan" value="<?= $cmd['pertemuan'] ?>">
																			<input type="hidden" name="mention" id="mention" value="<?= $cmd['user_komen'] ?>">
																			<input type="hidden" name="reply_to" id="reply_to" value="<?= $cmd['id'] ?>">
																			<input type="hidden" name="user_komen" id="user_komen" value="<?= $this->session->userdata('user'); ?>">
																			<textarea name="komentar" id="editor<?= $cmd['id'] ?>" rows="10" cols="45" placeholder="Type Here"></textarea>

																			<div class="form-group mt-2">
																				<label>Lampirkan Gambar</label>
																				<div class="custom-file">
																					<input type="file" class="custom-file-input" name="gambar" id="gambar">
																					<label class="custom-file-label" for="customFile">Choose file</label>
																				</div>
																			</div>
																			<div class="input-group-append">
																				<button class="btn btn-info" type="submit"><i class="fa fa-fw fa-paper-plane"></i> Submit</button>
																			</div>
																		</form>
																	</div>
																</div>
															</div>

															<?php $reply = $this->db->get_where('tbl_komen_forum', ['id_forum' => $val['id_forum'], 'pertemuan' => $val['pertemuan'], 'reply_to' => $cmd['id']]);
															foreach ($reply->result_array() as $rep) :
																$rep_siswa = $this->db->get_where('tbl_siswa', ['siswa_nis' => $rep['user_komen']])->row_array();
																// $rep_nilai = $this->db->get_where('tbl_nilai_onclass', ['user_siswa' => $rep['user_komen'], 'id_pelajaran' => $val['id_forum'], 'pertemuan_ke' => $val['pertemuan'], 'tipe' => 'Forum'])->num_rows();
																$rep_nilai = $this->db->get_where('tbl_nilai_onclass', ['user_siswa' => $rep['user_komen'], 'id_pelajaran' => $val['id_forum'], 'pertemuan_ke' => $val['pertemuan'], 'tipe' => 'Forum'])->row_array();
																$score = empty($rep_nilai['nilai']) ? '' : ' (' . $rep_nilai['nilai'] . ' point)';

																$admin = $this->db->get_where('tbl_pengguna', ['pengguna_username' => $rep['user_komen']])->row_array();

																$rep_user = empty($rep_siswa) ? $admin['pengguna_nama'] . ' (pengajar)' : $rep_siswa['siswa_nama'] . $score;
																$mention = $this->db->get_where('tbl_siswa', ['siswa_nis' => $rep['mention']])->row_array(); ?>
																<!-- Reply Main Comments -->
																<div class="collapse <?= $this->session->flashdata('mention') == $cmd['id'] ? 'show' : '' ?>" id="comments-<?= $cmd['id'] ?>">
																	<div class="col-lg ml-3">
																		<div class="card-header bordered mt-3 d-flex">
																			<div class="col-md-1">
																				<img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid" />
																			</div>
																			<div class="col-md">
																				<strong class="float-left"><?= $rep_user ?></strong>
																				<small class="float-right text-secondary">
																					<div class="dropdown mx-1">
																						<a href="#" class="btn btn-link btn-xs" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																							<i class='fa fa-ellipsis-v'></i>
																						</a>
																						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
																							<?php if ($admin['pengguna_username'] != $this->session->userdata('username')) : ?>
																								<a class="dropdown-item" href="javascript:void(0)" onclick="nilai('<?= $rep['id'] ?>')" style="font-size: 12px; color: #007bff;">
																									<i class="fa fa-fw fa-check-square"></i> Nilai
																								</a>
																							<?php endif; ?>
																							<!-- <a class="dropdown-item" href="<?= site_url('forum/edit_komen/' . $rep['id']) ?>" style="font-size: 12px; color: #1e7e34;">
																								<i class="fa fa-fw fa-pencil-alt"></i> Sunting
																							</a> -->
																							<a class="dropdown-item" href="javascript:void(0)" onclick="hapus_subkomen('<?= $rep['id'] ?>')" style="font-size: 12px; color: #dc3545;">
																								<i class="fa fa-fw fa-times"></i> Hapus
																							</a>
																						</div>
																					</div>
																				</small>
																				<small class="float-right text-secondary"><?= date('d M y', strtotime($rep['createDate'])) ?></small>
																				<div class="clearfix"></div>
																			</div>
																		</div>
																		<div class="card-body bordered pb-0">
																			<p>
																				<b><?= $mention['siswa_nama'] ?></b> <?= $rep['isi_komen'] ?>
																			</p>
																			<?php if (!empty($rep['lampiran'])) : ?>
																				<?php if (is_array(unserialize($rep['lampiran']))) : ?>
																					<p><b>Lampiran</b></p>
																					<?php foreach (unserialize($rep['lampiran']) as $att) : ?>
																						<a href="<?= $att ?>" data-toggle="lightbox" data-gallery="gallery-<?= $rep['id'] ?>">
																							<img src="<?= $att ?>" class="img-thumbnail mb-3" style="max-height: 80px; max-width: 80px;">
																						</a>
																					<?php endforeach; ?>
																				<?php else : ?>
																					<p><b>Lampiran</b></p>
																					<a href="<?= unserialize($rep['lampiran']) ?>" data-toggle="lightbox" data-gallery="gallery-<?= $rep['id'] ?>">
																						<img src="<?= unserialize($rep['lampiran']) ?>" class="img-thumbnail mb-3" style="max-height: 80px; max-width: 80px;">
																					</a>
																				<?php endif; ?>
																			<?php endif; ?>
																			<div>
																				<a class="float-right btn btn-sm" data-toggle="collapse" href="#show_komen-<?= $rep['id'] ?>">
																					<i class="fa fa-fw fa-reply"></i> Balas
																				</a>
																			</div>
																			<div class="collapse pt-5" id="show_komen-<?= $rep['id'] ?>">
																				<div class="card card-body">
																					<form action="<?= site_url('forum/submit_komen') ?>" method="post" autocomplete="off" enctype="multipart/form-data">
																						<input type="hidden" name="id" id="id" value="<?= $cmd['id'] ?>">
																						<input type="hidden" name="id_forum" id="id_forum" value="<?= $rep['id_forum'] ?>">
																						<input type="hidden" name="pertemuan" id="pertemuan" value="<?= $rep['pertemuan'] ?>">
																						<input type="hidden" name="mention" id="mention" value="<?= $rep['user_komen'] ?>">
																						<input type="hidden" name="reply_to" id="reply_to" value="<?= $cmd['id'] ?>">
																						<input type="hidden" name="user_komen" id="user_komen" value="<?= $this->session->userdata('user'); ?>">
																						<textarea name="komentar" id="editor<?= $rep['id'] ?>" rows="10" cols="45" placeholder="Type Here"></textarea>

																						<div class="form-group mt-2">
																							<label>Lampirkan Gambar</label>
																							<div class="custom-file">
																								<input type="file" class="custom-file-input" name="gambar" id="gambar">
																								<label class="custom-file-label" for="customFile">Choose file</label>
																							</div>
																						</div>
																						<div class="input-group-append">
																							<button class="btn btn-info" type="submit"><i class="fa fa-fw fa-paper-plane"></i> Submit</button>
																						</div>
																					</form>
																				</div>
																			</div>
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
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><!-- /.container -->
</div><!-- /.content-wrapper -->

<!-- Modal -->
<div class="modal fade" id="nilaiModal" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form method="post" action="<?= site_url($this->uri->segment(1) . '/submit_nilai') ?>" autocomplete="off">
				<div class="modal-body">
					<input type="hidden" name="nis_siswa" id="nis_siswa">
					<input type="hidden" name="forum_id" id="forum_id">
					<input type="hidden" name="forum_ke" id="forum_ke">
					<input type="hidden" name="komen_forum" id="komen_forum">
					<input type="hidden" name="lamp_forum" id="lamp_forum">
					<div class="row">
						<div class="col">
							<p id="text"></p>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-2">
							<label class="control-label">Input Nilai</label>
						</div>
						<div class="col-1">
							<input type="text" name="nilai_siswa" id="nilai_siswa" class="form-control form-control-sm" required onkeypress="return CheckNumeric()">
						</div>
						<div class="col">
							<small class="form-text text-muted">Range 10 - 100</small>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>


<?php $this->load->view('pengajar/v_schedule') ?>

<?php $this->load->view('pengajar/layout/v_js'); ?>

<script>
	var method;

	$(document).on("click", '[data-toggle="lightbox"]', function(event) {
		event.preventDefault();
		$(this).ekkoLightbox();
	});

	$(document).ready(function() {
		// forum
		$.ajax({
			url: "<?= site_url('forum/datafr_id/') ?>" + <?= $this->uri->segment(2); ?>,
			context: document.body,
			dataType: 'json',
			success: function(data) {
				for (var i = 0; i < data.length; i++) {
					CKEDITOR.replace('editorfr' + data[i].id);
				}
			}
		});

		// balasan
		$.ajax({
			url: "<?= site_url('forum/data_id/') ?>" + <?= $this->uri->segment(2); ?>,
			context: document.body,
			dataType: 'json',
			success: function(data) {
				for (var i = 0; i < data.length; i++) {
					CKEDITOR.replace('editor' + data[i].id);
				}
			}
		});
	});

	$('input[type="file"]').on('change', function() {
		//get the file name
		var file = $(this).val();
		var fileName = file.replace('C:\\fakepath\\', '');
		//replace the "Choose a file" label
		$(this).next('.custom-file-label').html(fileName);
	});

	$('#exampleModal').on('hidden.bs.modal', function() {
		$('input, textarea').removeClass('is-invalid');
		$('span.help-block').empty();
	});

	$('input, textarea').keypress(function() {
		$(this).removeClass('is-invalid');
		$(this).next().empty();
	});

	$('#myTab.nav-link').on('click', function(e) {
		e.preventDefault()
		$(this).tab('show')
	});

	// msg error nilai siswa
</script>

<script>
	<?php $msg = $this->session->flashdata('msg');
	if (!empty($msg)) :
		if ($msg['status'] == false) : ?>
			Swal.fire({
				title: 'Oops!',
				text: '<?= $msg['text'] ?>',
				icon: 'warning',
			});
		<?php else : ?>
			Swal.fire({
				title: 'Success',
				text: '<?= $msg['text'] ?>',
				icon: 'success',
			});
	<?php endif;
	endif; ?>

	function sts_forum(id) {
		$.ajax({
			url: '<?= site_url('forum/upd_status/') ?>' + id,
			type: 'POST',
			dataType: 'JSON',
			success: function(res) {
				Swal.fire({
					title: 'Sukses',
					icon: 'success',
					text: res.msg,
					timer: 2000,
					showConfirmButton: false
				}).then((res) => {
					if (res.dismiss === Swal.DismissReason.timer) {
						location.reload();
					}
				})
			}
		});
	}

	function delete_forum(id) {
		Swal.fire({
			title: 'Hapus forum ini?',
			text: "Semua isi komentar dalam forum ini akan terhapus.",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Hapus',
			cancelButtonText: 'Tidak'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: "<?= site_url('forum/delete_forum/') ?>" + id,
					type: "POST",
					dataType: "JSON",
					success: function(res) {
						Swal.fire({
							icon: 'success',
							title: 'Sukses',
							text: 'Forum berhasil dihapus',
							timer: 2000,
							timerProgressBar: true,
							// onBeforeOpen: () => {
							// Swal.showLoading()
							// },
							showConfirmButton: false
						}).then((result) => {
							if (result.dismiss === Swal.DismissReason.timer) {
								location.reload();
							}
						})
					}
				});
			}
		})
	}

	function nilai(id) {
		let url = "<?= site_url($this->uri->segment(1) . '/get_komen/') ?>" + id;

		$('#nilaiModal').modal('show');

		$.ajax({
			url: url,
			type: 'get',
			dataType: 'json',
			success: function(data) {
				var komen = data.komen;
				var nilai = (data.nilai == null) ? '' : data.nilai.nilai;
				var text = `Berikan nilai kepada <b>` + komen.siswa_nama + `</b> - <b>` + komen.kelas_nama + `</b> 
				untuk <b><?= ucfirst($this->uri->segment(1)); ?> ` + komen.nm_mapel + ` pertemuan ke-` + komen.pertemuan + `</b> tentang <b>` + komen.judul_materi + ` (` + komen.jns_materi + `)</b>`;
				$('#text').html(text);

				$('#nis_siswa').val(komen.siswa_nis);
				$('#forum_id').val('<?= $this->uri->segment(2) ?>');
				$('#forum_ke').val(komen.pertemuan);
				$('#komen_forum').val(komen.isi_komen);
				$('#lamp_forum').val(komen.lampiran);
				$('#nilai_siswa').val(nilai);
			}
		});
	}

	function hapus_komen(id) {
		Swal.fire({
			title: 'Hapus komentar ini?',
			text: "Komentar yang dihapus tidak bisa dikembalikan lagi!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Hapus',
			cancelButtonText: 'Tidak'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: "<?= site_url('forum/delete_komen/') ?>" + id,
					type: "POST",
					dataType: "JSON",
					success: function(res) {
						Swal.fire({
							icon: 'success',
							title: 'Sukses',
							text: res.msg,
							timer: 2000,
							timerProgressBar: true,
							// onBeforeOpen: () => {
							// Swal.showLoading()
							// },
							showConfirmButton: false
						}).then((result) => {
							if (result.dismiss === Swal.DismissReason.timer) {
								location.reload();
							}
						})
					}
				});
			}
		});
	}

	function hapus_subkomen(id) {
		Swal.fire({
			title: 'Hapus komentar ini?',
			text: "Komentar yang dihapus tidak bisa dikembalikan lagi!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Hapus',
			cancelButtonText: 'Tidak'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: "<?= site_url('forum/delete_subkomen/') ?>" + id,
					type: "POST",
					dataType: "JSON",
					success: function(res) {
						Swal.fire({
							icon: 'success',
							title: 'Sukses',
							text: res.msg,
							timer: 2000,
							timerProgressBar: true,
							// onBeforeOpen: () => {
							// Swal.showLoading()
							// },
							showConfirmButton: false
						}).then((result) => {
							if (result.dismiss === Swal.DismissReason.timer) {
								location.reload();
							}
						})
					}
				});
			}
		})
	}
</script>
