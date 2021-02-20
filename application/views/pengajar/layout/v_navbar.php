<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white media-display">
	<div class="container">
<div>
		<!-- Right navbar links -->
		<ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto media-float" style="padding-right: 5em">
		    <li><a href="<?= site_url('login/logout') ?>" class="dropdown-item">Log Out</a></li>
		</ul>
		<img class="media-logo-show" src="<?= base_url('assets/images/mylogo.png') ?>" alt="logo" style="display: none; width: 20%; float:right">
		</div>
	</div>
</nav>
<!-- /.navbar -->
<div class="jumbotron text-center m-0 p-4">
	<div class="row">
		<?php $nis = $this->session->userdata('username');
		$siswa = $this->db->select('*')->from('tbl_siswa a')->join('tbl_kelas b', 'a.siswa_kelas_id = b.kelas_id', 'inner')->where('a.siswa_nis', $nis)->get()->row_array(); ?>

		<div class="offset-1 col-sm-2 media-header media-nav">
			<?php if (empty($siswa['kelas_nama'])) : ?>
				<img class="img-fluid img-thumbnail rounded-circle" src="<?= base_url() . '/assets/images/user_blank.png' ?>" style="width: 80%">
			<?php else : ?>
				<img class="img-fluid img-thumbnail rounded-circle" src="<?= base_url() . '/assets/filesiswa/' . $nis . '/' . $siswa['siswa_photo'] ?>" style="width: 80%">
			<?php endif; ?>
		</div>
		<div class="col-sm-3" style="padding-top: 1em">
			<h3 class="text-left media-align-center"><?= $this->session->userdata('nama'); ?></h3>
			<p class="text-left text-muted media-align-center"><?= empty($siswa['kelas_nama']) ? 'Pengajar' : $siswa['kelas_nama'] ?></p>
		</div>

		<div class="offset-1 col-sm-3 media-logo-none" style="padding-top: 1em">
			<!-- <p class="text-left">PKBM ANAK PANAH HS</p> -->
			<img src="<?= base_url('assets/images/mylogo.png') ?>" alt="logo" style="width: 80%;">
		</div>
	</div>
</div>
<div class="dropdown-divider mb-0"></div>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white" style="z-index: 0">
	<div class="container">
		<div class="offset-1 col-sm-10 media-nav">
			<div class="glider-contain">
				<div class="glider">
					<a href="<?= site_url('dashboard') ?>" class="nav-link" id="home">Home</a>
					<a href="<?= site_url('course') ?>" class="nav-link" id="course">Course</a>
					<a href="<?= site_url('penilaian') ?>" class="nav-link" id="score">Score</a>
					<a href="<?= site_url('kisikisi/kisikisi_pengajar') ?>" class="nav-link" id="kisi-kisi">Kisi-Kisi</a>
					<!-- <a href="<?= site_url('absensi/list_kc_mapel') ?>" class="nav-link" id="schedule">Absensi Offline</a> -->
				</div>

				<button aria-label="Previous" class="glider-prev">&#8249;</button>
				<button aria-label="Next" class="glider-next">&#8250;</button>
				<!-- <div role="tablist" class="dots"></div> -->
			</div>
		</div>
	</div>
</nav>
<!-- /.navbar -->
