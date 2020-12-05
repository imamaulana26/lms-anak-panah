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
	<!-- Main content -->
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="offset-1 col-sm-10">
					<!-- <span class="btn btn-primary float-right" onclick="add_forum()">Buat Forum Baru</span> -->
					<a href="<?= site_url('tugas/' . $data['id_pelajaran']) ?>" class="btn btn-link float-right">Back to Tugas</a>
					<h2 class="pb-3">Tugas <?= $data['nm_mapel']; ?></h2>

					<div class="card">
						<div class="card-body">
							<form id="fm_forum" autocomplete="off">
								<div class="form-group row">
									<label for="judul_materi" class="col-sm-2 col-form-label">Judul Materi</label>
									<div class="col-sm-10">
										<input type="hidden" class="form-control" name="kd_mapel" id="kd_mapel" value="<?= $data['id_pelajaran'] ?>">
										<input type="text" class="form-control" name="judul_materi" id="judul_materi">
										<span class="help-block"></span>
									</div>
								</div>
								<div class="form-group row">
									<label for="isi_materi" class="col-sm-2 col-form-label">Isi Materi</label>
									<div class="col-sm-10">
										<textarea class="form-control" name="isi_materi" id="ckeditor" cols="30" rows="4"></textarea>
										<span class="help-block"></span>
									</div>
								</div>
								<div class="form-group row">
									<label for="lampiran" class="col-sm-2 control-label">Lampiran Gambar</label>
									<div class="col-sm-10">
										<span class="attach"><i class="fa fa-fw fa-paperclip" style="color: #007bff; cursor: pointer;"></i></span>
										<!-- <div class="custom-file">
											<input type="file" class="custom-file-input" name="lampiran" id="lampiran">
											<label class="custom-file-label" for="customFile">Choose file</label>
										</div> -->
									</div>
								</div>
								<div class="form-group row">
									<div class="offset-2 col-md-10" id="gallery"></div>
								</div>
								<fieldset class="form-group">
									<div class="row">
										<label class="col-form-label col-sm-2 pt-0">Tipe Forum</label>
										<div class="col-sm-10">
											<div class="form-check">
												<label class="form-check-label" for="tipe_forum1">
													<input class="form-check-input" type="radio" name="tipe_forum" id="tipe_forum1" value="Teori">
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
										<span class="btn btn-primary" id="btn_save" onclick="save_forum()">Simpan</span>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><!-- /.container -->
</div><!-- /.content-wrapper -->

<!-- Modal -->
<div class="modal fade" id="updModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">Form Upload</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="fm_upload" enctype="multipart/form-data" autocomplete="off">
					<div class="form-group row">
						<label for="lampiran" class="col-sm-3 control-label">Lampiran Gambar</label>
						<div class="col-sm-8">
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="lampiran[]" id="lampiran" multiple>
								<label class="custom-file-label" for="customFile">Choose file</label>
							</div>
						</div>
						<div class="col-sm-1" id="add">
							<span class="btn btn-default btn_add"><i class="fa fa-fw fa-plus"></i></span>
						</div>
					</div>
					<div class="clone"></div>
					<div class="form-group row">
						<div class="col-sm-9 offset-3">
							<button type="submit" class="btn btn-primary" id="btn_upload">Upload</button>
						</div>
					</div>
				</form>
			</div>
			<!-- <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Understood</button>
			</div> -->
		</div>
	</div>
</div>

<?php $this->load->view('pengajar/layout/v_js'); ?>

<script>
	let editor = CKEDITOR.replace('ckeditor');
	var i = 0;

	$(document).on("click", '[data-toggle="lightbox"]', function(event) {
		event.preventDefault();
		$(this).ekkoLightbox();
	});

	$('input, textarea').keypress(function() {
		$(this).removeClass('is-invalid');
		$(this).next().empty();
	});

	$('input[type="file"]').on('change', function() {
		//get the file name
		var file = $(this).val();
		var fileName = file.replace('C:\\fakepath\\', '');
		//replace the "Choose a file" label
		$(this).next('.custom-file-label').html(fileName);
	});

	$('.attach').on('click', function() {
		$('#updModal').modal('show');
	});

	$('#fm_upload').on('change', 'input[type="file"]', function() {
		//get the file name
		var file = $(this).val();
		var fileName = file.replace('C:\\fakepath\\', '');
		//replace the "Choose a file" label
		$(this).next('.custom-file-label').html(fileName);

		var size = $(this)[0].files[0].size / 1000;

		if ($(this)[0].files[0].type != 'image/jpeg' && $(this)[0].files[0].type != 'image/png') {
			Swal.fire({
				title: 'Oops!',
				icon: 'warning',
				text: 'File format tidak valid!'
			});
			$(this).next('.custom-file-label').html('Choose file');
			$(this).val('');
		} else {
			if (size > 2048) {
				Swal.fire({
					title: 'Oops!',
					icon: 'warning',
					text: 'Ukuran file melebihin batas 2MB!'
				});
				$(this).next('.custom-file-label').html('Choose file');
				$(this).val('');
			}
		}
	});

	$('.btn_add').click(function() {
		var html = '';
		html += `<div class="form-group row">
						<div class="offset-3 col-sm-8">
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="lampiran[]" id="lampiran" multiple>
								<label class="custom-file-label" for="customFile">Choose file</label>
							</div>
						</div>
						<div class="col-sm-1">
							<span class="btn btn-default btn_delete"><i class="fa fa-fw fa-minus"></i></span>
						</div>
					</div>`;

		if (i < 2) {
			$('.clone').append(html);
			i++;
		} else {
			Swal.fire({
				title: 'Oops!',
				icon: 'warning',
				text: 'Lampiran telah mencapai batas!'
			});
		}
	});

	$('#fm_upload').on('click', '.btn_delete', function() {
		$(this).parent().parent().remove();
		i--;
	});

	$('#fm_upload').submit(function(e) {
		e.preventDefault();
		url = '<?= site_url('tugas/upload') ?>';

		$.ajax({
			url: url,
			type: 'post',
			dataType: 'json',
			data: new FormData(this),
			cache: false,
			contentType: false,
			processData: false,
			beforeSend: function() {
				$('#btn_upload').attr('disabled', true);
				$('#btn_upload').html('<i class="fa fa-fw fa-spinner fa-pulse"></i> Loading');
			},
			success: function(respon) {
				Swal.fire({
					icon: respon.icon,
					title: respon.title,
					text: respon.msg,
					timer: 2000,
					timerProgressBar: true,
					showConfirmButton: false
				}).then((result) => {
					$('#updModal').modal('hide');

					$('#lampiran').next('.custom-file-label').text('Choose file');
					$('#btn_upload').attr('disabled', false);
					$('#btn_upload').text('Upload');
				});

				var content = '';
				for (let i = 0; i < respon.lampiran.length; i++) {
					content += `<a href="` + respon.lampiran[i] + `" data-toggle="lightbox" data-gallery="gallery">
											<img src="` + respon.lampiran[i] + `" class="img-thumbnail" style="max-height: 100px; max-width: 100px;">
										</a>`;
				}
				$('#gallery').html(content);
			}
		});
		return false;
	});

	function save_forum() {
		var data = {
			'id_fm': $('#id_fm').val(),
			'kd_mapel': $('#kd_mapel').val(),
			'judul_materi': $('#judul_materi').val(),
			'isi_materi': editor.getData(),
			'tipe_forum': $('input[name="tipe_forum"]:checked').val()
		}

		var msg = 'Tugas ' + data['judul_materi'] + ' berhasil disimpan';

		$.ajax({
			url: '<?= site_url('tugas/save_tugas') ?>',
			type: "POST",
			dataType: "JSON",
			data: data,
			beforeSend: function() {
				$('#btn_save').attr('disabled', true);
				$('#btn_save').html('<i class="fa fa-fw fa-spinner fa-pulse"></i> Loading');
			},
			success: function(res) {
				if (res.status) {
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
							$(location).attr('href', '<?= site_url('tugas/') ?>' + res.id);
						}
					})
				} else {
					for (var i = 0; i < res.inputerror.length; i++) {
						if (res.error[i] == '') {
							$('[name="' + res.inputerror[i] + '"]').addClass('is-invalid');
						} else {
							$('[name="' + res.inputerror[i] + '"]').addClass('is-invalid');
							$('[name="' + res.inputerror[i] + '"]').next().addClass('invalid-feedback').text(res.error[i]);
						}
					}
				}
			}
		});
	}
</script>
