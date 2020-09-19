<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
	<div class="container">
		<button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<!-- <div class="collapse navbar-collapse order-3" id="navbarCollapse">
			Left navbar links
			<ul class="navbar-nav" style="padding-left: 5em">
				<li class="nav-item dropdown">
					<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle" onclick="myFunction()"><i class="fas fa-fw fa-bars" id="icon"></i> Menu</a>
					<ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
						<li><a href="<?= site_url('dashboard') ?>" class="dropdown-item">Dashboard</a></li>
						<li class="dropdown-divider"></li>
						Level two dropdown
						<li class="dropdown-submenu dropdown-hover">
                            <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Private</a>
                            <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                <li><a tabindex="-1" href="#" class="dropdown-item">level 2</a></li>
                                <li class="dropdown-divider"></li>
                                <li class="dropdown-submenu">
                                    <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">level 2</a>
                                    <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                                        <li><a href="#" class="dropdown-item">3rd level</a></li>
                                        <li class="dropdown-divider"></li>
                                        <li><a href="#" class="dropdown-item">3rd level</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li><a href="#" class="dropdown-item">level 2</a></li>
                                <li class="dropdown-divider"></li>
                                <li><a href="#" class="dropdown-item">level 2</a></li>
                            </ul>
                        </li>
						<li class="dropdown-divider"></li>
						End Level two
						<li><a href="<?= site_url('kisikisi') ?>" class="dropdown-item">Exam</a></li>
						<li class="dropdown-divider"></li>
						<li><a href="<?= site_url('keuangan_siswa') ?>" class="dropdown-item">Finance</a></li>
						<li class="dropdown-divider"></li>
						<li><a href="#" class="dropdown-item">Library</a></li>
						<li class="dropdown-divider"></li>
						<li><a href="#" class="dropdown-item">Graduation</a></li>
						<li class="dropdown-divider"></li>
						<li><a href="#" class="dropdown-item">Services</a></li>
						<li class="dropdown-divider"></li>
						<li><a href="#" class="dropdown-item">Registration</a></li>
					</ul>
				</li>
			</ul>
		</div> -->

		<!-- Right navbar links -->
		<ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto" style="padding-right: 5em">
			<li class="nav-item dropdown">
				<a href="<?= site_url('inbox') ?>" class="nav-link">
					<?php $sumMail = $this->db->select_sum('inbox_status')->from('tbl_inbox')->where('inbox_kontak', $this->session->userdata('username'))->get()->row_array(); ?>
					<i class="fa fa-envelope"></i><?= $sumMail['inbox_status'] > 0 ? '<small class="badge badge-notify text-center">' . $sumMail['inbox_status'] . '</small>' : ''; ?>
				</a>
			</li>
			<li class="nav-item dropdown">
				<?php $notif = $this->db->select('*')->from('tbl_pengguna a')
					->join('tbl_komen_forum b', 'b.user_komen = a.pengguna_username')
					->join('tbl_materi_forum c', 'b.id_forum = c.id_forum and b.pertemuan = c.pertemuan', 'inner')
					->join('tbl_pelajaran d', ' b.id_forum = d.id_pelajaran')
					->join('tbl_mapel e', ' d.kd_mapel = e.kd_mapel')
					->where(['b.mention' => $this->session->userdata('username')])->limit(4)->get();
				$count = $this->db->select('*')->from('tbl_pengguna a')
					->join('tbl_komen_forum b', 'b.user_komen = a.pengguna_username')
					->join('tbl_materi_forum c', 'b.id_forum = c.id_forum and b.pertemuan = c.pertemuan', 'inner')
					->join('tbl_pelajaran d', ' b.id_forum = d.id_pelajaran')
					->join('tbl_mapel e', ' d.kd_mapel = e.kd_mapel')
					->where(['b.mention' => $this->session->userdata('username')])->get()->num_rows(); ?>

				<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fa fa-bell"></i><?= $count > 0 ? '<small class="badge badge-notify text-center">' . $count . '</small>' : '' ?></a>
				<?php if ($count > 0) : ?>
					<ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="width: 280px;">
						<?php foreach ($notif->result_array() as $res) : ?>
							<a href="<?= site_url('forum/' . $res['id_forum']) ?>" class="dropdown-item">
								<div class="media">
									<div class="media-body">
										<h3 class="dropdown-item-title pb-1"><?= $res['pengguna_nama']; ?></h3>
										<div class="row">
											<div class="col-sm-1 mr-2"><i class="fa fa-comments"></i></div>
											<div class="col-sm">
												<p class="text-sm">Berkomentar pada forum <br><?= $res['judul_materi']; ?></p>
											</div>
										</div>
										<!-- <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p> -->
									</div>
								</div>
								<!-- Message End -->
							</a>
							<li class="dropdown-divider"></li>
						<?php endforeach; ?>
						<li class="text-center"><a href="<?= site_url('notifikasi') ?>" class="dropdown-item">Lihat semua komentar</a></li>
					</ul>
				<?php endif; ?>
			</li>
			<li class="nav-item dropdown">
				<a id="dropdownSubMenu2" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fas fa-user-circle"></i></a>
				<ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
					<li><a href="<?= site_url('biodata') ?>" class="dropdown-item">Profile</a></li>
					<li><a href="<?= site_url('login/logout') ?>" class="dropdown-item">Log Out</a></li>
				</ul>
			</li>
		</ul>
	</div>
</nav>
<!-- /.navbar -->
<div class="jumbotron text-center m-0 p-4">
	<div class="row">
		<?php $nis = $this->session->userdata('username');
		$siswa = $this->db->select('*')->from('tbl_siswa a')->join('tbl_kelas b', 'a.siswa_kelas_id = b.kelas_id', 'inner')->where('a.siswa_nis', $nis)->get()->row_array(); ?>

		<div class="offset-1 col-sm-2" style="padding-left: 50px">
			<img class="img-fluid img-thumbnail rounded-circle" src="<?= base_url() . '/assets/filesiswa/' . $nis . '/' . $siswa['siswa_photo'] ?>" style="width: 80%">

		</div>
		<div class="col-sm-3" style="padding-top: 1em">
			<h3 class="text-left"><?= $this->session->userdata('nama'); ?></h3>
			<p class="text-left text-muted"><?= $siswa['kelas_nama'] ?></p>
		</div>

		<div class="offset-1 col-sm-3" style="padding-top: 1em">
			<!-- <p class="text-left">PKBM ANAK PANAH HS</p> -->
			<img src="<?= base_url('assets/images/mylogo.png') ?>" alt="logo" style="width: 80%;">
		</div>
	</div>
</div>
<div class="dropdown-divider mb-0"></div>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white" style="z-index: 0">
	<div class="container">
		<div class="offset-1 col-sm-10">
			<div class="glider-contain">
				<div class="glider">
					<a href="<?= site_url('dashboard') ?>" class="nav-link" id="home">Home</a>
					<a href="<?= site_url('course') ?>" class="nav-link" id="course">Course</a>
					<?php if ($siswa['oc'] == 1) {
					?>
						<a href="<?= site_url('onlineclass') ?>" class="nav-link" id="course">Online Class</a>
					<?php } ?>
					<a href="<?= site_url('kisikisi') ?>" class="nav-link" id="kisikisi">Kisi-kisi</a>
					<a href="#" class="nav-link" id="schedule">Schedule</a>
					<a href="#" class="nav-link" id="score">Score</a>
				</div>

				<button aria-label="Previous" class="glider-prev">&#8249;</button>
				<button aria-label="Next" class="glider-next">&#8250;</button>
				<!-- <div role="tablist" class="dots"></div> -->
			</div>
		</div>
	</div>
</nav>
<!-- /.navbar -->
