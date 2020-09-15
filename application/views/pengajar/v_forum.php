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
	<?php $page = (empty($this->session->flashdata('page'))) ? 1 : $this->session->flashdata('page'); ?>
	<!-- Main content -->
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="offset-1 col-sm-10">
					<span class="btn btn-primary float-right" onclick="add_forum()">Buat Forum Baru</span>
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
												<a href="<?= site_url('forum/edit_forum/' . $val['id']) ?>" style="color: #1e7e34;"><i class="fa fa-fw fa-pencil-alt ml-3"></i></a>
												<a href="javascript:void(0)" onclick="delete_forum('<?= $val['id'] ?>')" style="color: #dc3545;"><i class="fa fa-fw fa-times ml-3"></i></a>
											</span>
										</div>
										<div class="card-body">
											<p><?= $val['isi_materi'] ?></p>
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
														<form action="<?= site_url('forum/submit_main') ?>" method="post" autocomplete="off" id="my-awesome-dropzone" class="dropzone" enctype="multipart/form-data">
															<input type="hidden" name="id" id="id" value="<?= $val['id'] ?>">
															<input type="hidden" name="id_forum" id="id_forum" value="<?= $val['id_forum'] ?>">
															<input type="hidden" name="pertemuan" id="pertemuan" value="<?= $val['pertemuan'] ?>">
															<input type="hidden" name="user_komen" id="user_komen" value="<?= $this->session->userdata('user'); ?>">
															<div class="input-group">
																<!-- <input type="text" name="komentar" class="form-control" id="komentar" placeholder="Tulis balasan..."> -->
																<textarea name="komentar" id="editorfr<?= $val['id'] ?>" placeholder="Type Here"></textarea>
															</div>

															<div class="form-group">
																<label for="gambar">Masukan Gambar disini</label>
																<input type="file" class="form-control-file" id="gambar" name="gambar">
															</div>
															<div class="input-group-append" style="width: 100%">
																<button class="btn btn-info" type="submit" style="width: 100%"><i class="fa fa-fw fa-paper-plane"></i></button>
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

															$admin = $this->db->get_where('tbl_pengguna', ['pengguna_username' => $cmd['user_komen']])->row_array();
															$rep_user = ($siswa == null) ? $admin['pengguna_nama'] . ' (pengajar)' : $siswa['siswa_nama']; ?>
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
																				<a class="dropdown-item" href="<?= site_url('forum/edit_komen/' . $cmd['id']) ?>" style="font-size: 12px; color: #1e7e34;">
																					<i class="fa fa-fw fa-pencil-alt"></i> Sunting
																				</a>
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
																			<div class="form-group">
																				<!-- <input type="text" name="komentar" class="form-control" id="komentar" placeholder="Tulis balasan..."> -->
																				<textarea name="komentar" id="editor<?= $cmd['id'] ?>" rows="10" cols="45" placeholder="Type Here"></textarea>
																			</div>

																			<div class="form-group">
																				<label for="gambar">Masukan Gambar disini</label>
																				<input type="file" class="form-control-file" id="gambar" name="gambar">
																			</div>
																			<div class="input-group-append" style="width: 100%">
																				<button class="btn btn-info" type="submit" style="width: 100%"><i class="fa fa-fw fa-paper-plane"></i></button>
																			</div>
																		</form>
																	</div>
																</div>
															</div>

															<?php $reply = $this->db->get_where('tbl_komen_forum', ['id_forum' => $val['id_forum'], 'pertemuan' => $val['pertemuan'], 'reply_to' => $cmd['id']]);
															foreach ($reply->result_array() as $rep) :
																$rep_siswa = $this->db->get_where('tbl_siswa', ['siswa_nis' => $rep['user_komen']])->row_array();
																$admin = $this->db->get_where('tbl_pengguna', ['pengguna_username' => $rep['user_komen']])->row_array();

																$rep_user = ($rep_siswa == null) ? $admin['pengguna_nama'] . ' (pengajar)' : $rep_siswa['siswa_nama'];
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
																							<a class="dropdown-item" href="<?= site_url('forum/edit_komen/' . $rep['id']) ?>" style="font-size: 12px; color: #1e7e34;">
																								<i class="fa fa-fw fa-pencil-alt"></i> Sunting
																							</a>
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
																						<div class="form-group">
																							<!-- <input type="text" name="komentar" class="form-control" id="komentar" placeholder="Tulis balasan..."> -->
																							<textarea name="komentar" id="editor<?= $rep['id'] ?>" rows="10" cols="45" placeholder="Type Here"></textarea>
																						</div>

																						<div class="form-group">
																							<label for="gambar">Masukan Gambar disini</label>
																							<input type="file" class="form-control-file" id="gambar" name="gambar">
																						</div>
																						<div class="input-group-append" style="width: 100%">
																							<button class="btn btn-info" type="submit" style="width: 100%"><i class="fa fa-fw fa-paper-plane"></i></button>
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

	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel"></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="fm_forum" autocomplete="off">
						<div class="form-group row">
							<label for="judul_materi" class="col-sm-2 col-form-label">Judul Materi</label>
							<div class="col-sm-10">
								<input type="hidden" class="form-control" name="id_fm" id="id_fm">
								<input type="hidden" class="form-control" name="kd_mapel" id="kd_mapel" value="<?= $this->uri->segment(2); ?>">
								<input type="text" class="form-control" name="judul_materi" id="judul_materi">
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group row">
							<label for="isi_materi" class="col-sm-2 col-form-label">Isi Materi</label>
							<div class="col-sm-10">
								<textarea class="form-control" name="isi_materi" id="isi_materi" cols="30" rows="4"></textarea>
								<span class="help-block"></span>
							</div>
						</div>
						<fieldset class="form-group">
							<div class="row">
								<label class="col-form-label col-sm-2 pt-0">Tipe Forum</label>
								<div class="col-sm-10">
									<div class="form-check">
										<label class="form-check-label" for="tipe_forum1">
											<input class="form-check-input" type="radio" name="tipe_forum" id="tipe_forum1" value="Teori" checked>
											Teori
										</label>
									</div>
									<div class="form-check">
										<label class="form-check-label" for="tipe_forum2">
											<input class="form-check-input" type="radio" name="tipe_forum" id="tipe_forum2" value="Praktek">
											Praktek
										</label>
									</div>
								</div>
							</div>
						</fieldset>
						<div class="form-group row">
							<div class="col-sm-10 offset-2">
								<span class="btn btn-primary" onclick="save_forum()">Simpan</span>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div><!-- /.content-wrapper -->


<?php $this->load->view('pengajar/v_schedule') ?>
</div>

<?php $this->load->view('pengajar/layout/v_js'); ?>

<script>
	var method;

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

	function add_forum() {
		method = 'add';

		$('#fm_forum')[0].reset();
		$('#exampleModal').modal('show');

		$('.modal-title').text('Buat Forum Baru');
	}

	function edit_forum(id) {
		url = 'update';

		$.ajax({
			url: "<?= site_url('forum/edit_forum/') ?>" + id,
			type: "POST",
			dataType: "JSON",
			success: function(data) {
				$('#exampleModal').modal('show');

				$('.modal-title').text('Sunting Forum');

				$('#id_fm').val(data.id);
				$('#kd_mapel').val(data.id_forum);
				$('#judul_materi').val(data.judul_materi);
				$('#isi_materi').val(data.isi_materi);
				$('input:radio[name=tipe_forum][value=' + data.jns_materi + ']')[0].checked = true;
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
							// 	Swal.showLoading()
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

	function save_forum() {
		var url = '';
		var msg = '';

		if (method == 'add') {
			url = '<?= site_url('forum/save_forum') ?>';
			msg = 'Forum berhasil dibuat';
		} else {
			url = '<?= site_url('forum/update_forum') ?>';
			msg = 'Forum berhasil diubah';
		}

		$.ajax({
			url: url,
			type: "POST",
			dataType: "JSON",
			data: $('#fm_forum').serialize(),
			success: function(data) {
				if (data.status) {
					$('#exampleModal').modal('hide');
					Swal.fire({
						icon: 'success',
						title: 'Sukses',
						text: msg,
						timer: 2000,
						timerProgressBar: true,
						// onBeforeOpen: () => {
						// 	Swal.showLoading()
						// },
						showConfirmButton: false
					}).then((result) => {
						if (result.dismiss === Swal.DismissReason.timer) {
							location.reload();
						}
					})
				} else {
					for (var i = 0; i < data.inputerror.length; i++) {
						if (data.error[i] == '') {
							$('[name="' + data.inputerror[i] + '"]').addClass('is-invalid');
						} else {
							$('[name="' + data.inputerror[i] + '"]').addClass('is-invalid');
							$('[name="' + data.inputerror[i] + '"]').next().addClass('invalid-feedback').text(data.error[i]);
						}
					}
				}
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
							// 	Swal.showLoading()
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
							// 	Swal.showLoading()
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
