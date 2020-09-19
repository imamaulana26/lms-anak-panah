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
					<a href="<?= site_url('forum/' . $data['id_pelajaran']) ?>" class="btn btn-link float-right">Back to Forum</a>
					<h2 class="pb-3">Forum <?= $data['nm_mapel']; ?></h2>

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

<?php $this->load->view('pengajar/layout/v_js'); ?>

<script>
	let editor = CKEDITOR.replace('ckeditor');

	$('input, textarea').keypress(function() {
		$(this).removeClass('is-invalid');
		$(this).next().empty();
	});

	$('#myTab.nav-link').on('click', function(e) {
		e.preventDefault()
		$(this).tab('show')
	});

	function save_forum() {
		var data = {
			'id_fm': $('#id_fm').val(),
			'kd_mapel': $('#kd_mapel').val(),
			'judul_materi': $('#judul_materi').val(),
			'isi_materi': editor.getData(),
			'tipe_forum': $('input[name="tipe_forum"]:checked').val()
		}

		var msg = 'Forum ' + data['judul_materi'] + ' berhasil disimpan';

		$.ajax({
			url: '<?= site_url('forum/save_forum') ?>',
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
							$(location).attr('href', '<?= site_url('forum/') ?>' + res.id);
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
