<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
	<div class="container">
		<button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse order-3" id="navbarCollapse">
			<!-- Left navbar links -->
			<ul class="navbar-nav" style="padding-left: 5em">
				<li class="nav-item dropdown">
					<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle" onclick="myFunction()"><i class="fas fa-fw fa-bars" id="icon"></i> Menu</a>
					<ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
						<!-- <li><a href="<?= site_url('dashboard') ?>" class="dropdown-item">Dashboard</a></li> -->
						<!-- <li class="dropdown-divider"></li> -->
						<?php $sumMail = $this->db->select_sum('inbox_status')->from('tbl_inbox')->where('inbox_kontak', $this->session->userdata('username'))->get()->row_array(); ?>
						<li><a href="<?= site_url('inbox') ?>" class="dropdown-item">Mail <span class="badge badge-danger" style="position: relative; float: right; top: 0.25em;"><?= $sumMail['inbox_status'] ?></span></a></li>
						<li class="dropdown-divider"></li>
						<!-- Level two dropdown-->
						<!-- <li class="dropdown-submenu dropdown-hover">
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
                        </li> -->
						<!-- <li class="dropdown-divider"></li> -->
						<!-- End Level two -->
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

				<li class="nav-item">
					<span class="nav-link" id="clock"></span>
				</li>
			</ul>
		</div>

		<!-- Right navbar links -->
		<ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto" style="padding-right: 5em">
			<li class="nav-item dropdown">
				<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link"><i class="fas fa-cogs"></i></a>
				<ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
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
			<?php if (empty($siswa['kelas_nama'])) : ?>
				<img class="img-fluid img-thumbnail rounded-circle" src="<?= base_url() . '/assets/images/user_blank.png' ?>" style="width: 80%">
			<?php else : ?>
				<img class="img-fluid img-thumbnail rounded-circle" src="<?= base_url() . '/assets/filesiswa/' . $nis . '/' . $siswa['siswa_photo'] ?>" style="width: 80%">
			<?php endif; ?>
		</div>
		<div class="col-sm-3" style="padding-top: 1em">
			<h3 class="text-left"><?= $this->session->userdata('nama'); ?></h3>
			<p class="text-left text-muted"><?= empty($siswa['kelas_nama']) ? 'Pengajar' : $siswa['kelas_nama'] ?></p>
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
					<a href="<?= site_url('penilaian') ?>" class="nav-link" id="score">Score</a>
					<a href="#" class="nav-link" id="schedule">Schedule</a>
				</div>

				<button aria-label="Previous" class="glider-prev">&#8249;</button>
				<button aria-label="Next" class="glider-next">&#8250;</button>
				<!-- <div role="tablist" class="dots"></div> -->
			</div>
		</div>
	</div>
</nav>
<!-- /.navbar -->
