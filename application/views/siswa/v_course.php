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
									<p>OS1 - 1721 - ISYS6304 - THBA</p>
								</div>
								<div class="card-body">
									<a href="<?= site_url('forum/') . $val['id_pelajaran'] ?>" id="forum"><i class="fas fa-fw fa-comments pr-1"></i> <?= $n_forum ?> forum posting</a>
									<div class="dropdown-divider"></div>
									<a href="<?= site_url('tugas/') . $val['id_pelajaran'] ?>"><i class="fas fa-fw fa-tasks pr-1"></i> <?= $n_tugas ?> Assigment to do</a>
									<div class="dropdown-divider"></div>
									<a href="javascript:void(0)" id="view" data-toggle="modal" data-target="#modal_schedule"><i class="fas fa-fw fa-clipboard-list pr-1"></i> View schedule</a>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</div><!-- /.content -->

	<?php $this->load->view('siswa/v_schedule'); ?>
</div>
<!-- /.content-wrapper -->

<?php $this->load->view('siswa/layout/v_js'); ?>
