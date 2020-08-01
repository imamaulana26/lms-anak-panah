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
			<!-- Tagihan -->
			<div class="row">
				<div class="offset-1 col-sm-10">
					<!-- Index Prestasi -->
					<div class="card card-primary card-outline">

						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="Biodata-tab" data-toggle="tab" href="#Biodata" role="tab" aria-controls="Biodata" aria-selected="true"><i class="fas fa-fw fa-user fa-lg" style="padding-right: 1.5em"></i>Biodata</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="gantiPassword-tab" data-toggle="tab" href="#gantiPassword" role="tab" aria-controls="gantiPassword" aria-selected="false"><i class="fas fa-fw fa-cog fa-lg" style="padding-right: 1.5em"></i>Ganti Password</a>
							</li>
						</ul>

						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="Biodata" role="tabpanel" aria-labelledby="Biodata-tab">

								<?php $this->load->view('pengajar/layout/v_layout_biodata'); ?>

							</div>
							<div class="tab-pane fade" id="gantiPassword" role="tabpanel" aria-labelledby="gantiPassword-tab">
								<div class="card-body">
									<div class="row">
										<div class="col-sm">
											<!-- onsubmit="return checkForm(this);" -->
											<form action="<?= site_url('biodata/gantiPassword') ?>" method="post" onsubmit="return checkForm(this);">
												<div class="form-group row">
													<label for="inputEmail3" class="col-sm-2 col-form-label">Password</label>
													<div class="col-sm-4">
														<div class="input-group" id="show_hide_password">
															<input class="form-control" type="password" name="password1">
															<div class="input-group-append">
																<span class="input-group-text"><i class="fa fa-fw fa-eye-slash" style="cursor: pointer;"></i></span>
															</div>
														</div>
													</div>
												</div>

												<div class="form-group row">
													<label for="inputEmail3" class="col-sm-2 col-form-label">Confirm Password</label>
													<div class="col-sm-4">
														<div class="input-group" id="show_hide_password">
															<input class="form-control" type="password" name="password2">
															<div class="input-group-append">
																<span class="input-group-text"><i class="fa fa-fw fa-eye-slash" style="cursor: pointer;"></i></span>
															</div>
														</div>
													</div>
												</div>
												<button type="submit" class="btn btn-primary">Submit</button>
											</form>
										</div>
									</div>
								</div>

							</div>
						</div>

					</div><!-- /.col -->

				</div><!-- /.row -->
			</div>
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('pengajar/layout/v_js'); ?>

<script>
	function checkForm(form) {
		if (form.password1.value != form.password2.value) {
			alert("Your password and confirmation password do not match.");
			return false;
		}
	}

	$(document).ready(function() {

		$("#show_hide_password i").on('click', function(event) {
			event.preventDefault();
			if ($('#show_hide_password input').attr("type") == "text") {
				$('#show_hide_password input').attr('type', 'password');
				$('#show_hide_password i').addClass("fa-eye-slash");
				$('#show_hide_password i').removeClass("fa-eye");
			} else if ($('#show_hide_password input').attr("type") == "password") {
				$('#show_hide_password input').attr('type', 'text');
				$('#show_hide_password i').removeClass("fa-eye-slash");
				$('#show_hide_password i').addClass("fa-eye");
			}
		});
	});
</script>
