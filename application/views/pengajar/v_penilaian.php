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

			<!-- Tagihan -->
			<div class="row">
				<div class="offset-1 col-sm-10">
					<!-- Index Prestasi -->
					<!-- <div class="card card-primary card-outline">
						<div class="card-header">
							<h5 class="card-title m-0"><i class="fas fa-fw fa-sitemap fa-md mr-2"></i> Penilaian</h5>
						</div>
						<div class="card-body">
							<table class="table table-bordered table-hover" id="example1">
								<thead>
									<tr>
										<th style="width: 50px;">#</th>
										<th>Nama Pelajaran</th>
										<th class="text-center">Kelas</th>
										<th class="text-center">Absensi</th>
										<th class="text-center">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $no = 1;
									foreach ($nilai_mapel as $val) : ?>
										<tr>
											<td><?= $no++ ?></td>
											<td><?= $val['nm_mapel'] ?></td>
											<td class="text-center"><?= str_replace('Kelas', '', $val['kelas_nama']) ?></td>
											<td class="text-center"><?= $val['absen'] == null ? 0 : $val['absen'] ?> Siswa</td>
											<td class="text-center">
												<span class="btn btn-info btn-xs" title="View" onclick="view()"><i class="fa fa-fw fa-eye"></i></span>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div> -->

					<form id="form">
						<div class="row">
							<div class="col-4">
								<select name="kelas" id="kelas" class="form-control">
									<option selected disabled>-- Please Select --</option>
									<?php for ($i = 0; $i < count($kelas); $i++) : ?>
										<option value="<?= $kelas[$i]['id_kelas'] ?>"><?= $kelas[$i]['kelas_nama'] ?></option>
									<?php endfor; ?>
								</select>
							</div>
							<div class="col-6">
								<select name="mapel" id="mapel" class="form-control">
									<option selected disabled>-- Please Select --</option>
									<?php for ($i = 0; $i < count($mapel); $i++) : ?>
										<option value="<?= $mapel[$i]['kd_mapel'] ?>"><?= $mapel[$i]['nm_mapel'] ?></option>
									<?php endfor; ?>
								</select>
							</div>
					</form>
					<div class="col">
						<span class="btn btn-default" onclick="search()"><i class="fa fa-fw fa-search"></i> Search</span>
					</div>
				</div>
			</div><!-- /.col -->
		</div><!-- /.row -->

		<div class="row mt-5 display"></div>
	</div>

</div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<?php $this->load->view('pengajar/v_schedule') ?>
</div>

<?php $this->load->view('pengajar/layout/v_js'); ?>

<!-- script here -->
<script>
	function search() {
		$.ajax({
			url: '<?= site_url('penilaian/view_nilai') ?>',
			type: 'post',
			data: $('#form').serialize(),
			dataType: 'json',
			success: function(respon) {
				var html = '';

				var res = respon.data;
				// console.log(res.data);

				if (jQuery.isEmptyObject(res) === true) {
					html += `<div class='offset-1 col-10'>
									<div class="alert alert-info text-center" role="alert">
										Belum ada nilai untuk mata pelajaran ` + $('#mapel option:selected').text() + `
									</div>
								</div>`;
				} else {
					for (let i = 0; i < res.length; i++) {
						html += `<div class="col-4">
						<div class="card card-primary bg-light mb-3">
							<div class="card-header">` + res[i].data.siswa + `</div>
							<div class="card-body">
								<table class="table">
									<thead>
										<tr>
											<th>Petemuan</th>
											<th>Nilai</th>
										</tr>
									</thead>
									<tbody>`;
						if (jQuery.isEmptyObject(res[i].data.dt_forum) === false) {
							for (let n = 0; n < res[i].data.dt_forum.length; n++) {
								html += `<tr>
												<td>Forum ke-` + res[i].data.dt_forum[n].forum + `</td>
												<td>` + res[i].data.dt_forum[n].nilai + ` point</td>
											</tr>`;
							}
						}

						if (jQuery.isEmptyObject(res[i].data.dt_tugas) === false) {
							for (let n = 0; n < res[i].data.dt_tugas.length; n++) {
								html += `<tr>
												<td>Tugas ke-` + res[i].data.dt_tugas[n].tugas + `</td>
												<td>` + res[i].data.dt_tugas[n].nilai + ` point</td>
											</tr>`;
							}
						}
						html += `</tbody>
								</table>
							</div>
						</div>
					</div>`;
					}
				}

				$('.display').html(html);
			}
		});
	}
</script>
