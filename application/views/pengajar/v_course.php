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
			<div class="offset-1 col-sm-10">
				<div class="row">
					<?php foreach ($course->result_array() as $val) :
						$n_forum = $this->db->get_where('tbl_materi_forum', ['id_forum' => $val['id_pelajaran']])->num_rows();
						$n_tugas = $this->db->get_where('tbl_materi_tugas', ['id_forum' => $val['id_pelajaran']])->num_rows(); ?>
						<div class="col-sm-4">
							<div class="card mapel">
								<div class="card-img-caption">
									<img class="card-img-top" src="<?= base_url('assets/front-end/dist/img/gradient.jpg') ?>">
									<strong class="card-text"><?= strtoupper($val['nm_mapel']) ?></strong>
									<p><?= $val['kelas_nama'] ?></p>
								</div>
								<div class="card-body">
									<a href="<?= site_url('forum/') . $val['id_pelajaran'] ?>" id="forum"><i class="fas fa-fw fa-comments pr-1"></i> <?= $n_forum ?> forum posting</a>
									<div class="dropdown-divider"></div>
									<a href="<?= site_url('tugas/') . $val['id_pelajaran'] ?>"><i class="fas fa-fw fa-tasks pr-1"></i> <?= $n_tugas ?> Assigment to do</a>
									<div class="dropdown-divider"></div>
									<a href="javascript:void(0)" id="view" onclick="view('<?= $val['id_pelajaran'] ?>')"><i class="fas fa-fw fa-video pr-1"></i> Kelas Online</a>
									<div class="dropdown-divider"></div>
									<a href="<?= site_url('absensi/attendent_kc/') . $val['id_pelajaran'] ?>"><i class="fas fa-check-square pr-1"></i> Kelas Komunitas</a>
								</div>
							</div>
						</div>
						<!-- Modal option -->
						<!-- <div class="modal fade bd-example-modal-sm" id="option<?= $val['id_pelajaran'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="position: absolute;left: 50%;top: 20%;transform: translate(-50%, -50%);">
							<div class="modal-dialog modal-sm" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel"><?= $val['nm_mapel'] ?></h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body" style="text-align:center">
										<a class="btn btn-primary col-sm-5" href="<?= site_url('forum/') . $val['id_pelajaran'] ?>" role="button">Forum</a>
										<a class="btn btn-info col-sm-5" href="<?= site_url('absensi/') . $val['id_pelajaran'] ?>" role=" button">Absensi</a>
									</div>
								</div>
							</div>

						</div> -->

					<?php endforeach; ?>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</div><!-- /.content -->

	<?php $this->load->view('pengajar/v_kelasonline'); ?>
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('pengajar/layout/v_js'); ?>

<script type="text/javascript">
	function view(id) {
		$.ajax({
			url: '<?= site_url('course/view/') ?>' + id,
			type: 'post',
			dataType: 'json',
			success: function(data) {
				$('#modal_kelasonline').modal('show');
				$('.modal-title').text(data.nm_mapel + ' (' + data.kelas_nama + ')');

				$('#id').val(id);
				$('#jdl_kelas').val(data.tgl_oc);
				$('#link_oc').val(data.link_oc);
				$('#start_on').val(data.time_start);
				$('#end_on').val(data.time_end);
				$('input:radio[name=opsi_kls][value=' + data.aktifkan + ']')[0].checked = true;
			}
		});
	}

	function submit() {
		$.ajax({
			url: '<?= site_url('course/update_oc/') ?>',
			type: 'post',
			dataType: 'json',
			data: $('#fm_oc').serialize(),
			beforeSend: function() {
				$('.btn').html('<i class="fa fa-spin fa-spinner"></i> loading');
			},
			success: function(data) {
				alert(data.msg);
				location.reload();
			}
		})
	}

	function absensi_oc() {
		$.ajax({
			url: '<?= site_url('course/absensi_oc') ?>',
			type: 'post',
			dataType: 'json',
			data: $('#fm_oc').serialize(),
			beforeSend: function() {
				$('.btn').html('<i class="fa fa-spin fa-spinner"></i> loading');
			},
			success: function(data) {
				alert(data.msg);
				location.reload();
			}
		})
	}
</script>