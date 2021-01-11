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
				<div class="offset-md-1 col-md-10 col-sm">
					<!-- Course -->
					<div class="card card-primary card-outline">
						<div class="card-header">
							<h5 class="card-title m-0">Penilaian</h5>
							<!-- <a href="<?= site_url('course') ?>" class="m-auto" style="float: right; position: relative;">View All</a> -->
						</div>
						<div class="card-body">
							<div class="row display">
								<?php if ($course != null) : ?>
									<?php foreach ($course as $key => $val) : ?>
										<div class="col-md-4 col-sm">
											<div class="card card-primary bg-light mb-3">
												<div class="card-header"><?= $val['mapel']; ?></div>
												<div class="card-body">
													<table class="table">
														<thead>
															<tr>
																<th>Petemuan</th>
																<th>Nilai</th>
															</tr>
														</thead>
														<tbody>
															<?php if (array_key_exists('forum', $val['item'])) : ?>
																<?php for ($i = 0; $i < count($val['item']['forum']); $i++) : ?>
																	<tr>
																		<td>Forum ke-<?= $val['item']['forum'][$i]['pertemuan'] ?></td>
																		<td><?= $val['item']['forum'][$i]['nilai'] ?> point</td>
																	</tr>
																<?php endfor; ?>
															<?php endif; ?>

															<?php if (array_key_exists('tugas', $val['item'])) : ?>
																<?php for ($i = 0; $i < count($val['item']['tugas']); $i++) : ?>
																	<tr>
																		<td>Tugas ke-<?= $val['item']['tugas'][$i]['pertemuan'] ?></td>
																		<td><?= $val['item']['tugas'][$i]['nilai'] ?> point</td>
																	</tr>
																<?php endfor; ?>
															<?php endif; ?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									<?php endforeach; ?>
								<?php else : ?>
									<p class="text-center">Data nilai belum tersedia.</p>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div><!-- ./col -->
			</div><!-- ./row -->
		</div><!-- /.container-fluid -->
	</div><!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('siswa/layout/v_js'); ?>
