<style>
	.hidden {
		display: none;
	}

	iframe {
		width: -moz-available;
		width: -webkit-fill-available;
	}

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

	@media screen and (max-width: 574px) {
		div.bhoechie-tab-menu div.list-group>a.active:after {
			display: none;
		}

		div.bhoechie-tab-content {
			padding-left: 0px;
		}
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
				<div class="col-lg media-nav">
					<a href="#" class="btn btn-primary float-right">Buat Tugas Baru</a>
					<h2 class="pb-3">Tugas <?= $tugas['nm_mapel'] ?></h2>
					<div class="card card-outline">
						<div class="card-primary card-body row bhoechie-tab-container">
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 bhoechie-tab-menu">
								<?php $tanggal = date('d M Y', strtotime($tugas['createDate'])) . ' - ' . date('d M Y', strtotime($tugas['endDate'])); ?>
								<?php for ($i = 1; $i <= $total; $i++) {
								?>
									<div class="list-group nav flex-column nav-pills mb-1 ">
										<a href="<?= site_url('tugas/tugas_sg/') . $this->uri->segment(3) . "/" . $i ?>" class="nav-link list-group-item <?= ($i == $this->uri->segment(4)) ? 'active' : ' '; ?>">
											<h5>
												Tugas Ke <?= $i ?>
											</h5>
											<small><?= ($i == $this->uri->segment(4)) ? $tanggal : '...'; ?></small>
											<p><?= word_limiter('Lorem Ipsum Dolor', 2) ?></p>
										</a>
									</div>
								<?php } ?>
							</div>

							<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">
								<div class="bhoechie-tab-content tab-pane fade active show" id="tugas" role="tabpanel" aria-labelledby="tugas-tab">
									<div class="card-header">
										<label><?= $tugas['judul_materi']  ?></label>
										<span class="float-right">
											<a href="#" class="badge badge-info">Absensi</a>
											<a href="javascript:void(0)" class="badge badge" onclick="sts_forum('#')"></a>
											<a href="#" style="color: #1e7e34;"><i class="fa fa-fw fa-pencil-alt ml-3"></i></a>
											<a href="javascript:void(0)" onclick="delete_forum('#')" style="color: #dc3545;"><i class="fa fa-fw fa-times ml-3"></i></a>
										</span>
									</div>
									<div class="card-body">
										<p><?= $tugas['isi_materi'] ?></p>

										<hr class="media-line">
										<div>
											<a class="float-right btn btn-sm" onclick="balas_main()">
												<i class="fa fa-fw fa-reply"></i> Balas
											</a>


											<span class="btn btn-default" id="img1" onclick="load_komen_bn()">
												belum dinilai
											</span>
											<span class="btn btn-default" id="img2" onclick="load_komen_sn()">
												sudah dinilai
											</span>
											<!-- <span class="btn btn-default" onclick="load_komen_bn()">
												<a href="https://www.w3schools.com" target="iframe_a">W3Schools.com</a>
											</span>

											<span class="btn btn-default" onclick="load_komen_sn()">
												(#<?= $komen_sn['jml'] ?> Sudah Dinilai)
											</span> -->
										</div>
										<!-- <div class="card-body">
											<div class="box-body">
												<iframe src="demo_iframe.htm" name="iframe_a" height="300px" width="100%" title="Iframe Example"></iframe>
											</div>
										</div> -->




										<!-- <div class="card-body">
											<div class="box-body">
												<div id="load_data"></div>
												<div id="load_data_message"></div>
											</div>
										</div> -->
										<div class="card-body">
											<div id="div1" class='hidden'>
												<!-- belum dinilai -->
												<div class="box-body">
													<div id="load_data"></div>
													<div id="load_data_message"></div>
												</div>
											</div>
											<div id="div2" class='hidden'>
												<!-- sudah dinilai -->
												<div class="box-body">
													<div id="load_data2"></div>
													<div id="load_data_message2"></div>
												</div>
											</div>
										</div>

										<!-- text area -->
										<div class="row" id="form_komen">
											<div class="col-md-12" id="style_form" style="display: none;">
												<div class="card">
													<div class="card-header">
														<span class="btn btn-xs btn-danger float-right" id="btn_close"><i class="fa fa-fw fa-times"></i></span>
														<strong>Form Komentar</strong>
													</div>
													<div class="card-body">
														<form id="form" method="POST" autocomplete="off" enctype="multipart/form-data">
															<input type="hidden" class="form-control" name="id_reply" id="id_reply">
															<input type="hidden" class="form-control" name="id_forum" id="id_forum">
															<input type="hidden" class="form-control" name="pertemuan" id="pertemuan">
															<input type="hidden" class="form-control" name="mention" id="mention">
															<input type="hidden" class="form-control" name="reply_to" id="reply_to">
															<input type="hidden" class="form-control" name="user_komen" value="<?= $_SESSION['user']; ?>">

															<textarea class="form-control" id="editor" name="komentar"></textarea>
															<div class="form-group mt-2">
																<label>Lampirkan Gambar</label>
																<div class="custom-file">
																	<input type="file" class="custom-file-input" name="gambar">
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
										<!-- end text area -->

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><!-- /.container -->
</div><!-- /.content-wrapper -->

<?php $this->load->view('pengajar/v_schedule') ?>
</div>

<?php $this->load->view('pengajar/layout/v_js'); ?>
<!-- ajax load -->
<script>
	$(document).on("click", '[data-toggle="lightbox"]', function(event) {
		event.preventDefault();
		$(this).ekkoLightbox();
	});

	$(document).ready(function() {
		CKEDITOR.replace('editor');

		$("#img1").on('click', function() {
			$("#div1").fadeIn();
			$("#div2").fadeOut();
		});
		$("#img2").on('click', function() {
			$("#div2").fadeIn();
			$("#div1").fadeOut();
		});

		$('input[type="file"]').on('change', function() {
			//get the file name
			var file = $(this).val();
			var fileName = file.replace('C:\\fakepath\\', '');
			//replace the "Choose a file" label
			$(this).next('.custom-file-label').html(fileName);
		});

		$('#btn_close').on('click', function() {
			$('#section_komen').removeClass();
			$('#form_komen').fadeOut();
			$('body').css('overflow', 'auto');
		});
	});
</script>

<script>
	var url = $(location).attr('href');
	var segments = url.split('/');
	var id = segments[6];
	var prt = segments[7];

	function lazzy_loader(limit) {
		var output = '';
		for (var count = 0; count < limit; count++) {
			output += '<div class="post_data mt-3">';
			output += '<p><span class="content-placeholder" style="width:100%; height: 30px;">&nbsp;</span></p>';
			output += '<p><span class="content-placeholder" style="width:100%; height: 100px;">&nbsp;</span></p>';
			output += '</div>';
		}
		$('#load_data_message').html(output);
		$('#load_data_message2').html(output);
	}

	//komen yang sudah dinilai
	function load_komen_sn() {
		var limit = 3;
		var start = 0;
		var action = 'inactive';

		$('#load_data2').empty();
		lazzy_loader(limit);

		function load_data_sn(limit, start) {
			// $("#load_data").empty();
			$.ajax({
				url: "<?php echo base_url(); ?>tugas/fetch_sn",
				method: "POST",
				data: {
					limit: limit,
					start: start,
					id_tugas: id,
					pertemuan: prt
				},
				cache: false,
				success: function(data) {
					$('#load_data_message2').html("");
					if (data == '') {
						action = 'active';
					} else {
						action = 'inactive';
						$('#load_data2').append(data);
					}
				}
			})
		}

		if (action == 'inactive') {
			action = 'active';
			load_data_sn(limit, start);
		}

		$(window).scroll(function() {
			if ($(window).scrollTop() + $(window).height() > $("#load_data2").height() && action == 'inactive') {
				lazzy_loader(limit);
				action = 'active';
				start = start + limit;
				setTimeout(function() {
					load_data_sn(limit, start);
				}, 1000);
			}
		});
	};

	//komen belum dinilai
	function load_komen_bn() {
		var limit = 3;
		var start = 0;
		var action = 'inactive';

		$('#load_data').empty();
		lazzy_loader(limit);

		function load_data_bn(limit, start) {
			// $("#load_data2").empty();
			$.ajax({
				url: "<?php echo base_url(); ?>tugas/fetch",
				method: "POST",
				data: {
					limit: limit,
					start: start,
					id_tugas: id,
					pertemuan: prt
				},
				cache: false,
				success: function(data) {
					$('#load_data_message').html("");
					if (data == '') {
						action = 'active';
					} else {
						action = 'inactive';
						$('#load_data').append(data);
					}
				}
			})
		}

		if (action == 'inactive') {
			action = 'active';
			load_data_bn(limit, start);
		}

		$(window).scroll(function() {
			if ($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive') {
				lazzy_loader(limit);
				action = 'active';
				start = start + limit;
				setTimeout(function() {
					load_data_bn(limit, start);
				}, 1000);
			}
		});
	};


	function balas_main() {
		// $(window).scrollTop(0);

		$('#form').attr('action', '<?= site_url('tugas/submit_main') ?>');

		$('#section_komen').addClass('block');
		$('#form_komen').fadeIn();
		// $('#form_komen').animate({width: "50%", height: "50%"}, 'slow');
		$('#style_form').css({
			'display': 'unset',
			'position': 'absolute',
			'z-index': '1036',
			'bottom': '0',
			'top': '0',
			'right': '10%',
			'transform': 'translate(-50 % , -50 % )'
		});
		$("html, body").animate({
			scrollTop: $("#style_form").offset().top
		}, 500);
		$('body').css('overflow', 'hidden');

		$('#id_reply').val('');
		$('#id_forum').val(id);
		$('#pertemuan').val(prt);
		$('#mention').val('');
		$('#reply_to').val('');
	}

	function balas_komen(id) {
		// $(window).scrollTop(0);

		$('#section_komen').addClass('block');
		$('#form_komen').fadeIn();
		// $('#form_komen').animate({width: "50%", height: "50%"}, 'slow');
		$('#style_form').css({
			'display': 'unset',
			'position': 'absolute',
			'z-index': '1036',
			'bottom': '0',
			'top': '0',
			// 'top': '10 %',
			'right': '10 %',
			'transform': 'translate(-50 % , -50 % )'
		});
		$("html, body").animate({
			scrollTop: $("#style_form").offset().top
		}, 500);
		$('body').css('overflow', 'hidden');

		$('#section_komen').addClass('block');
		$('#form_komen').fadeIn();
		$('body').css('overflow', 'hidden');

		$.ajax({
			url: "<?= site_url('tugas/get_komen/') ?>" + id,
			type: "POST",
			dataType: "JSON",
			success: function(respon) {
				var respon = respon.komen;

				$('#form').attr('action', '<?= site_url('tugas/submit_komen') ?>');

				$('#id_reply').val(id);
				$('#id_forum').val(respon.id_pelajaran);
				$('#pertemuan').val(respon.pertemuan);
				$('#mention').val(respon.siswa_nis);
				$('#reply_to').val(id);
			}
		});
	}
</script>
<!--end of ajax load-- >
