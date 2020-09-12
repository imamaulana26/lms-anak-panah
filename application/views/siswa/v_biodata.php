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
					<div class="card">
						<div class="card-header">
							<ul class="nav nav-pills" id="pills-tab" role="tablist">
								<li class="nav-item" role="presentation">
									<a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a>
								</li>
								<li class="nav-item" role="presentation">
									<a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Contact Person</a>
								</li>
								<li class="nav-item" role="presentation">
									<a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#pills-setting" role="tab" aria-controls="pills-setting" aria-selected="false">Setting</a>
								</li>
							</ul>
						</div>
						<div class="card-body">
							<div class="tab-content" id="pills-tabContent">
								<div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
									<table class="table table-hover">
										<tr>
											<th style="width: 25%">Nama Lengkap</th>
											<td style="width: 15px">:</td>
											<td><?= $siswa['siswa_nama'] ?></td>
										</tr>
										<tr>
											<th style="width: 25%">NIS Siswa</th>
											<td style="width: 15px">:</td>
											<td><?= $siswa['siswa_nis'] ?></td>
										</tr>
										<tr>
											<th style="width: 25%">NISN Siswa</th>
											<td style="width: 15px">:</td>
											<td><?= $siswa['siswa_nisn'] ?></td>
										</tr>
										<tr>
											<th style="width: 25%">Jenis Kelamin</th>
											<td style="width: 15px">:</td>
											<td><?= $siswa['siswa_jenkel'] == 'P' ? 'Perempuan' : 'Laki-laki' ?></td>
										</tr>
										<tr>
											<th style="width: 25%">Kelas</th>
											<td style="width: 15px">:</td>
											<td><?= substr($siswa['kelas_nama'], 6, 10) ?></td>
										</tr>
										<tr>
											<th style="width: 25%">Tempat, Tanggal Lahir</th>
											<td style="width: 15px">:</td>
											<td><?= $siswa['siswa_tempat'] . ', ' . tgl_indo($siswa['siswa_tgl_lahir']) ?></td>
										</tr>
										<tr>
											<th style="width: 25%">Agama</th>
											<td style="width: 15px">:</td>
											<td><?= $siswa['agama_nama'] ?></td>
										</tr>
										<tr>
											<th style="width: 25%">Kewarganegaraan</th>
											<td style="width: 15px">:</td>
											<td><?= $siswa['siswa_kewarganegaraan'] ?></td>
										</tr>
										<tr>
											<th style="width: 25%">No. Telepon Siswa</th>
											<td style="width: 15px">:</td>
											<td><?= $siswa['siswa_no_telp'] == '' ? '-' : $siswa['siswa_no_telp'] ?></td>
										</tr>
										<tr>
											<th style="width: 25%">Sekolah Asal Siswa</th>
											<td style="width: 15px">:</td>
											<td><?= $siswa['sekolah_asal'] ?></td>
										</tr>
										<tr>
											<th style="width: 25%">Alamat Siswa</th>
											<td style="width: 15px">:</td>
											<td><?= $siswa['siswa_alamat'] ?></td>
										</tr>
									</table>
								</div>
								<div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
									<ul class="nav nav-tabs" id="myTab" role="tablist">
										<li class="nav-item" role="presentation">
											<a class="nav-link active" id="ayah-tab" data-toggle="tab" href="#ayah" role="tab" aria-controls="ayah" aria-selected="true">Ayah</a>
										</li>
										<li class="nav-item" role="presentation">
											<a class="nav-link" id="ibu-tab" data-toggle="tab" href="#ibu" role="tab" aria-controls="ibu" aria-selected="false">Ibu</a>
										</li>
										<li class="nav-item" role="presentation">
											<a class="nav-link" id="wali-tab" data-toggle="tab" href="#wali" role="tab" aria-controls="wali" aria-selected="false">Wali</a>
										</li>
									</ul>
									<div class="tab-content" id="myTabContent">
										<div class="tab-pane fade show active" id="ayah" role="tabpanel" aria-labelledby="ayah-tab">
											<table class="table table-hover">
												<tr>
													<th style="width: 25%">No. NIK</th>
													<td style="width: 15px">:</td>
													<td><?= $siswa['ayah_nik'] == '' ? '-' : $siswa['ayah_nik'] ?></td>
												</tr>
												<tr>
													<th style="width: 25%">Nama Lengkap</th>
													<td style="width: 15px">:</td>
													<td><?= $siswa['ayah_nama'] ?></td>
												</tr>
												<tr>
													<th style="width: 25%">Tempat, Tanggal Lahir</th>
													<td style="width: 15px">:</td>
													<td><?= $siswa['ayah_tempat'] . ', ' . tgl_indo($siswa['ayah_tanggal']) ?></td>
												</tr>
												<tr>
													<th style="width: 25%">Pendidikan Terkahir</th>
													<td style="width: 15px">:</td>
													<td><?= strtoupper($siswa['ayah_pendidikan']) ?></td>
												</tr>
												<tr>
													<th style="width: 25%">Pekerjaan</th>
													<td style="width: 15px">:</td>
													<td><?= $siswa['ayah_pekerjaan'] ?></td>
												</tr>
												<tr>
													<th style="width: 25%">Penghasilan</th>
													<td style="width: 15px">:</td>
													<td><?= 'Rp ' . number_format($siswa['ayah_penghasilan'], 0, ',', '.') . '/bulan' ?></td>
												</tr>
												<tr>
													<th style="width: 25%">No. Telepon</th>
													<td style="width: 15px">:</td>
													<td><?= $siswa['no_telp_ayah'] ?></td>
												</tr>
												<tr>
													<th style="width: 25%">Email</th>
													<td style="width: 15px">:</td>
													<td><?= $siswa['email_ayah'] ?></td>
												</tr>
											</table>
										</div>
										<div class="tab-pane fade" id="ibu" role="tabpanel" aria-labelledby="ibu-tab">
											<table class="table table-hover">
												<tr>
													<th style="width: 25%">No. NIK</th>
													<td style="width: 15px">:</td>
													<td><?= $siswa['ibu_nik'] == '' ? '-' : $siswa['ibu_nik'] ?></td>
												</tr>
												<tr>
													<th style="width: 25%">Nama Lengkap</th>
													<td style="width: 15px">:</td>
													<td><?= $siswa['ibu_nama'] ?></td>
												</tr>
												<tr>
													<th style="width: 25%">Tempat, Tanggal Lahir</th>
													<td style="width: 15px">:</td>
													<td><?= $siswa['ibu_tempat'] . ', ' . tgl_indo($siswa['ibu_tanggal']) ?></td>
												</tr>
												<tr>
													<th style="width: 25%">Pendidikan Terkahir</th>
													<td style="width: 15px">:</td>
													<td><?= strtoupper($siswa['ibu_pendidikan']) ?></td>
												</tr>
												<tr>
													<th style="width: 25%">Pekerjaan</th>
													<td style="width: 15px">:</td>
													<td><?= $siswa['ibu_pekerjaan'] ?></td>
												</tr>
												<tr>
													<th style="width: 25%">Penghasilan</th>
													<td style="width: 15px">:</td>
													<td><?= 'Rp ' . number_format($siswa['ibu_penghasilan'], 0, ',', '.') . '/bulan' ?></td>
												</tr>
												<tr>
													<th style="width: 25%">No. Telepon</th>
													<td style="width: 15px">:</td>
													<td><?= $siswa['no_telp_ibu'] ?></td>
												</tr>
												<tr>
													<th style="width: 25%">Email</th>
													<td style="width: 15px">:</td>
													<td><?= $siswa['email_ibu'] ?></td>
												</tr>
											</table>
										</div>
										<div class="tab-pane fade" id="wali" role="tabpanel" aria-labelledby="wali-tab">
											<table class="table table-hover">
												<tr>
													<th style="width: 25%">No. NIK</th>
													<td style="width: 15px">:</td>
													<td><?= $siswa['wali_nik'] == '' ? '-' : $siswa['wali_nik'] ?></td>
												</tr>
												<tr>
													<th style="width: 25%">Nama Lengkap</th>
													<td style="width: 15px">:</td>
													<td><?= $siswa['wali_nama'] == '' ? '-' : $siswa['wali_nama'] ?></td>
												</tr>
												<tr>
													<th style="width: 25%">Tempat, Tanggal Lahir</th>
													<td style="width: 15px">:</td>
													<td><?= $siswa['wali_tempat'] == '' ? '-' :
																$siswa['wali_tempat'] . ', ' . tgl_indo($siswa['wali_tanggal']) ?></td>
												</tr>
												<tr>
													<th style="width: 25%">Pendidikan Terkahir</th>
													<td style="width: 15px">:</td>
													<td><?= $siswa['wali_pendidikan'] == '' ? '-' : strtoupper($siswa['wali_pendidikan']) ?></td>
												</tr>
												<tr>
													<th style="width: 25%">Pekerjaan</th>
													<td style="width: 15px">:</td>
													<td><?= $siswa['wali_pekerjaan'] == '' ? '-' : $siswa['wali_pekerjaan'] ?></td>
												</tr>
												<tr>
													<th style="width: 25%">Penghasilan</th>
													<td style="width: 15px">:</td>
													<td><?= $siswa['wali_penghasilan'] == '' ? '-' : 'Rp ' . number_format($siswa['wali_penghasilan'], 0, ',', '.') . '/bulan' ?></td>
												</tr>
												<tr>
													<th style="width: 25%">No. Telepon</th>
													<td style="width: 15px">:</td>
													<td><?= $siswa['wali_notelp'] == '' ? '-' : $siswa['wali_notelp'] ?></td>
												</tr>
												<tr>
													<th style="width: 25%">Alamat Wali</th>
													<td style="width: 15px">:</td>
													<td><?= $siswa['wali_alamat'] == '' ? '-' : $siswa['wali_alamat'] ?></td>
												</tr>
											</table>
										</div>
									</div>
								</div>
								<div class="tab-pane fade" id="pills-setting" role="tabpanel" aria-labelledby="pills-setting-tab">
									<form id="fm_password">
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Password</label>
											<div class="col-sm-4">
												<input type="password" class="form-control" name="current_pass" id="current_pass">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Password Baru</label>
											<div class="col-sm-4">
												<input type="password" class="form-control" name="new_pass" id="new_pass">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Confirm Password</label>
											<div class="col-sm-4">
												<input type="password" class="form-control" name="confirm_pass" id="confirm_pass">
											</div>
										</div>
										<div class="form-group row">
											<div class="offset-2 col-sm-4">
												<div class="form-check">
													<input class="form-check-input" type="checkbox" id="show_pass" style="cursor: pointer;">
													<label class="form-check-label" for="show_pass" style="cursor: pointer;">
														Show Password
													</label>
												</div>
											</div>
										</div>
										<div class="form-group row">
											<div class="offset-2 col-sm-6">
												<span class="btn btn-info" onclick="fm_submit()">Change password</span>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div><!-- /.row -->
			</div>
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('siswa/layout/v_js'); ?>

<script>
	// function checkForm(form) {
	// 	if (form.password1.value != form.password2.value) {
	// 		alert("Your password and confirmation password do not match.");
	// 		return false;
	// 	}
	// }

	// $(document).ready(function() {

	// 	$("#show_hide_password i").on('click', function(event) {
	// 		event.preventDefault();
	// 		if ($('#show_hide_password input').attr("type") == "text") {
	// 			$('#show_hide_password input').attr('type', 'password');
	// 			$('#show_hide_password i').addClass("fa-eye-slash");
	// 			$('#show_hide_password i').removeClass("fa-eye");
	// 		} else if ($('#show_hide_password input').attr("type") == "password") {
	// 			$('#show_hide_password input').attr('type', 'text');
	// 			$('#show_hide_password i').removeClass("fa-eye-slash");
	// 			$('#show_hide_password i').addClass("fa-eye");
	// 		}
	// 	});
	// });

	$(document).ready(function() {
		$('input[type="checkbox"]').click(function() {
			if ($(this).prop("checked") == true) {
				console.log("Checkbox is checked.");

				$('#new_pass, #confirm_pass').attr('type', 'text');
			} else if ($(this).prop("checked") == false) {
				console.log("Checkbox is unchecked.");

				$('#new_pass, #confirm_pass').attr('type', 'password');
			}
		});
	});

	function fm_submit() {
		$.ajax({
			url: '<?= site_url('biodata/gantiPassword') ?>',
			type: 'post',
			dataType: 'json',
			data: $('#fm_password').serialize(),
			success: function(res) {
				if (res.icon == 'success') {
					Swal.fire({
						icon: res.icon,
						title: res.msg,
						showConfirmButton: false,
						timer: 1500
					})
				} else {
					Swal.fire({
						icon: res.icon,
						title: res.msg,
						showConfirmButton: true,
					})
				}
			}
		});
	}
</script>
