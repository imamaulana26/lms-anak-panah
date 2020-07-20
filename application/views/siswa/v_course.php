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
					<!-- <?php for ($i = 1; $i <= 3; $i++) {
								for ($j = 1; $j <= 3; $j++) { ?>
							<div class="col-sm-4">
								<div class="card mapel">
									<div class="card-img-caption">
										<img class="card-img-top" src="<?= base_url('assets/front-end/dist/img/gradient.jpg') ?>">
										<strong class="card-text">BUSINESS APPLICATION DEVELOPMENT</strong>
										<p>OS1 - 1721 - ISYS6304 - THBA</p>
									</div>
									<div class="card-body">
										<a href="#" id="forum"><i class="fas fa-fw fa-comments pr-1"></i> <?= rand(0, 10) ?> new forum posting</a>
										<div class="dropdown-divider"></div>
										<a href="#"><i class="fas fa-fw fa-tasks pr-1"></i> <?= rand(0, 10) ?> Assigment to do</a>
										<div class="dropdown-divider"></div>
										<a href="javascript:void(0)" id="view" data-toggle="modal" data-target="#modal_schedule"><i class="fas fa-fw fa-clipboard-list pr-1"></i> View schedule</a>
									</div>
								</div>
							</div>
					<?php }
								echo "<br>";
							} ?> -->

					<?php foreach ($course->result_array() as $val) :
						$n_forum = $this->db->get_where('tbl_materi', ['id_forum' => $val['id_pelajaran']])->num_rows(); ?>
						<div class="col-sm-4">
							<div class="card mapel">
								<div class="card-img-caption">
									<img class="card-img-top" src="<?= base_url('assets/front-end/dist/img/gradient.jpg') ?>">
									<strong class="card-text"><?= strtoupper($val['nm_mapel']) ?></strong>
									<p>OS1 - 1721 - ISYS6304 - THBA</p>
								</div>
								<div class="card-body">
									<a href="<?= site_url('forum/') . $val['id_pelajaran'] ?>" id="forum"><i class="fas fa-fw fa-comments pr-1"></i> <?= $n_forum ?> new forum posting</a>
									<div class="dropdown-divider"></div>
									<a href="#"><i class="fas fa-fw fa-tasks pr-1"></i> <?= rand(0, 10) ?> Assigment to do</a>
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
