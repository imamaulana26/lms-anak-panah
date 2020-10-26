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
					<a href="<?= site_url(strtolower($title) . '/' . $data['id_forum']) ?>" class="btn btn-link float-right">Back to <?= $title ?></a>
					<h2 class="pb-3"><?= $title . ' ' . $data['nm_mapel']; ?></h2>

					<div class="card">
						<div class="card-body">
							<form id="fm_forum" autocomplete="off">
								<div class="form-group row">
									<label for="isi_komen" class="col-sm-2 col-form-label">Isi Komen</label>
									<div class="col-sm-10">
										<input type="hidden" class="form-control" name="id_fm" id="id_fm" value="<?= $data['id'] ?>">
										<input type="hidden" class="form-control" name="kd_mapel" id="kd_mapel" value="<?= $data['id_pelajaran'] ?>">
										<textarea class="form-control" name="isi_komen" id="ckeditor" cols="30" rows="4"><?= $data['isi_komen'] ?></textarea>
										<span class="help-block"></span>
									</div>
								</div>
								<div class='form-group row'>
									<label class='col-sm-2 col-form-label'>
										<span class='attach'>Lampiran <i class='fa fa-fw fa-paperclip' style='color: #007bff; cursor: pointer;'></i></span>
									</label>
									<div class='col-sm-10'>
										<?php if ($this->session->userdata('lampiran') != null) : ?>
											<?php foreach ($this->session->userdata('lampiran') as $val) : ?>
												<a href="<?= $val ?>" data-toggle="lightbox" data-gallery="gallery">
													<img src="<?= $val ?>" class="img-thumbnail" style="max-height: 80px; max-width: 80px;">
												</a>
											<?php endforeach; ?>
										<?php else : ?>
											<?php if ($data['lampiran'] != null) : ?>
												<?php if (is_array(unserialize($data['lampiran']))) : ?>
													<?php foreach (unserialize($data['lampiran']) as $val) : ?>
														<a href="<?= $val ?>" data-toggle="lightbox" data-gallery="gallery">
															<img src="<?= $val ?>" class="img-thumbnail" style="max-height: 80px; max-width: 80px;">
														</a>
													<?php endforeach; ?>
												<?php else : ?>
													<a href="<?= unserialize($data['lampiran']) ?>" data-toggle="lightbox" data-gallery="gallery">
														<img src="<?= unserialize($data['lampiran']) ?>" class="img-thumbnail" style="max-height: 80px; max-width: 80px;">
													</a>
												<?php endif; ?>
											<?php endif; ?>
										<?php endif; ?>
									</div>
								</div>
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
		</div>
	</div>
</div>

<?php $this->load->view('pengajar/layout/v_js'); ?>

<script>
	var i = 0;

	(function() {
		var mathElements = [
			'math',
			'maction',
			'maligngroup',
			'malignmark',
			'menclose',
			'merror',
			'mfenced',
			'mfrac',
			'mglyph',
			'mi',
			'mlabeledtr',
			'mlongdiv',
			'mmultiscripts',
			'mn',
			'mo',
			'mover',
			'mpadded',
			'mphantom',
			'mroot',
			'mrow',
			'ms',
			'mscarries',
			'mscarry',
			'msgroup',
			'msline',
			'mspace',
			'msqrt',
			'msrow',
			'mstack',
			'mstyle',
			'msub',
			'msup',
			'msubsup',
			'mtable',
			'mtd',
			'mtext',
			'mtr',
			'munder',
			'munderover',
			'semantics',
			'annotation',
			'annotation-xml'
		];

		CKEDITOR.replace('ckeditor', {
			extraAllowedContent: mathElements.join(' ') + '(*)[*]{*};img[data-mathml,data-custom-editor,role](Wirisformula)'
		});
	}());

	$(document).on("click", '[data-toggle="lightbox"]', function(evt) {
		evt.preventDefault();
		$(this).ekkoLightbox();
	});

	var editor = CKEDITOR.instances["ckeditor"];
	editor.setData(`<?= $data["isi_komen"] ?>`);

	$('input, textarea').keypress(function() {
		$(this).removeClass('is-invalid');
		$(this).next().empty();
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
		url = '<?= site_url(strtolower($title) . '/upload') ?>';

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
					location.reload();
					$('#updModal').modal('hide');

					$('#lampiran').next('.custom-file-label').text('Choose file');
					$('#btn_upload').attr('disabled', false);
					$('#btn_upload').text('Upload');
				});
			}
		});
		return false;
	});

	function save_forum() {
		var data = {
			'id_fm': $('#id_fm').val(),
			'kd_mapel': $('#kd_mapel').val(),
			'judul_materi': $('#judul_materi').val(),
			'isi_materi': editor.getData()
		}

		url = '<?= site_url(strtolower($title) . '/update_komen') ?>';
		msg = 'Komentar berhasil diubah';

		$.ajax({
			url: url,
			type: "POST",
			dataType: "JSON",
			data: data,
			beforeSend: function() {
				$('#btn_save').attr('disabled', true);
				$('#btn_save').html('<i class="fa fa-fw fa-spinner fa-pulse"></i> Loading');
			},
			success: function(data) {
				let url = "<?= site_url(strtolower($title) . '/') ?>" + data['id'];

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
							$(location).attr('href', url);
						}
					})
				}
			}
		});
	}
</script>
