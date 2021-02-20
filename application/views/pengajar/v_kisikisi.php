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
				<div class="offset-1 col-sm-10 media-nav">
					<!-- Index Prestasi -->
					<div class="card card-primary card-outline">
						<div class="card-header">
							<h5 class="card-title m-0"><i class="fas fa-fw fa-clipboard-list fa-lg"></i> Kisi-Kisi</h5>
						</div>
						<div class="card-body">
							<div class="row">
								<table id="example1" class="table table-striped table-hover">
									<thead>
										<tr>
											<th>No</th>
											<th>kls</th>
											<th>Mata Pelajaran</th>
											<th>Sms</th>
											<th>UB</th>
											<th>Kisi-Kisi</th>
										</tr>
									</thead>
									<tbody>
										<?php

										// $this->db->select('*')->from('tbl_kisikisi a')->join('tbl_mapel b', 'a.kisikisi_mapel = b.kd_mapel', 'inner')->join('tbl_kelas c', 'a.kisikisi_kelas_id = c.kelas_id', 'inner')->where(['a.kisikisi_kelas_id' => $kelas['siswa_kelas_id']])->get()->result_array(); 

										// var_dump($this->session->userdata()
										// );
										$kdpengajar = $this->db->get_where('tbl_pengajar', ['nm_pengajar' => $this->session->userdata('nama')])->row_array();
										$kelas = $this->db->get_where('tbl_pelajaran', ['kd_pengajar' => $kdpengajar['id_pengajar']])->result_array();
										$dummy = array();
										foreach ($kelas as $dt_kelas) {
											// $dumykelas = $dt_kelas['id_kelas'];
											$dummy[] = $dt_kelas['id_kelas'];
										}
										// $dtdummy
										$dtfix = array_merge(array_unique($dummy));
										$kls = '';
										foreach ($dtfix as $key => $val) {
											$kls .= $val . ', ';
										}
										// var_dump($kls); die;

										// var_dump($dtfix);
										$where = 'kisikisi_kelas_id in (' . substr($kls, 0, -2) . ')';

										// $kisikisi = $this->db->get_where('tbl_kisikisi', $where)->result_array();
										$kisikisi = $this->db->select('c.kelas_nama,a.kisikisi_semester,a.kisikisi_ub,a.kisikisi_deskripsi,b.nm_mapel')->from('tbl_kisikisi a')->join('tbl_mapel b', 'a.kisikisi_mapel = b.kd_mapel', 'inner')->join('tbl_kelas c', 'a.kisikisi_kelas_id = c.kelas_id', 'inner')->where($where)->get()->result_array();
										// var_dump($kisikisi);
										// $dtfix = array_merge($dtunsersql);
										?>
										<?php $no = 1;
										foreach ($kisikisi as $ks) {
										?>
											<tr>
												<td><?= $no++ ?></td>
												<td><?= substr($ks['kelas_nama'], 6) ?></td>
												<td><?= $ks['nm_mapel'] ?></td>
												<td><?= $ks['kisikisi_semester'] ?></td>
												<td><?= $ks['kisikisi_ub'] ?></td>
												<td><?= $ks['kisikisi_deskripsi'] ?></td>
											</tr>
										<?php }  ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div><!-- /.col -->
		</div><!-- /.row -->

	</div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<?php $this->load->view('pengajar/v_schedule'); ?>
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('pengajar/layout/v_js'); ?>

<!-- script here -->
<script>
	$("#example1").DataTable({
    "scrollX": true,
    pagingType: $(window).width() < 450 ? "simple" : "simple_numbers"
  });
</script>