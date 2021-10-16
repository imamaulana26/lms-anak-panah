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
			<!-- Kelas Online -->
			<div class="row">
				<div class="offset-1 col-sm-10 media-nav">
					<div class="card card-primary card-outline">
						<div class="card-body">
							<div class="col-md-12">
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th>Module</th>
											<th>Mata Pelajaran</th>
											<th>Tgl. Test Mulai</th>
											<th>Tgl. Test Selesai</th>
											<th>Waktu Pengerjaan</th>
											<th>Nilai</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($respon['data'] as $key => $val) : ?>
											<tr>
												<td class="text-center"><?= ($key + 1) ?></td>
												<td>UB- <?= $val['modul_ub']; ?></td>
												<td><?= $val['nm_mapel']; ?></td>
												<td><?= $val['time_start'] != null ? $val['time_start'] : '-' ?></td>
												<td><?= $val['time_end'] != null ? $val['time_end'] : '-' ?></td>
												<td><?= $val['batas_waktu_tes'] != null ? $val['batas_waktu_tes'] : '-' ?></td>
												<td><?= $val['nilai'] != null ? $val['nilai'] : '0.00' ?></td>
												<td class="text-center">
													<?php if ($val['nilai'] != null) : ?>
														<span class="badge badge-danger">Selesai</span>
													<?php else : ?>
														<a href="<?= site_url('siswa/dashboard/detail_soal/' . $val['id_modul']) ?>" target="_blank">
															<span class="badge badge-success" style="cursor: pointer;">Kerjakan</span>
														</a>
													<?php endif; ?>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /.row -->

			<!-- End Of Kelas Online -->
		</div><!-- /.container-fluid -->
	</div><!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('siswa/layout/v_js'); ?>
