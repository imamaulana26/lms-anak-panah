<!--Counter Inbox-->
<?php 
$query=$this->db->query("SELECT * FROM tbl_inbox WHERE inbox_status='1'");
$jum_pesan=$query->num_rows();
?>
<?php
$id_admin=$this->session->userdata('idadmin');
$q=$this->db->query("SELECT * FROM tbl_pengguna WHERE pengguna_id='$id_admin'");
$c=$q->row_array();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SEKOLAH ANAK PANAH | Input Nilai</title>
 <!-- Tell the browser to be responsive to screen width -->
  <link rel="shorcut icon" type="text/css" href="<?php echo base_url().'assets/images/favicon.png'?>">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/bootstrap/css/bootstrap.min.css'?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/datatables/dataTables.bootstrap.css'?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css'?>">
  <!-- Ionicons -->
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css'?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/AdminLTE.min.css'?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
   <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/skins/_all-skins.min.css'?>">

 </head>
 <body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <!--Header-->
    <?php 
    $this->load->view('admin/v_header');
    ?>

    <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">

          <li class="header">Menu Utama</li>
          <?php if ($c['pengguna_level']==1): ?>

            <li>
              <a href="<?php echo base_url().'dashboard'?>">
                <i class="fa fa-home"></i> <span>Dashboard</span>
                <span class="pull-right-container">
                  <small class="label pull-right"></small>
                </span>
              </a>
            </li>

            <li>
              <a href="<?php echo base_url().'datalembaga'?>">
                <i class="fa fa-building"></i> <span>Lembaga</span>
                <span class="pull-right-container">
                  <small class="label pull-right"></small>
                </span>
              </a>
            </li>

            <li>
              <a href="<?php echo base_url().'satelit'?>">
                <i class="fa fa-rocket"></i> <span>Data Satelit</span>
                <span class="pull-right-container">
                  <small class="label pull-right"></small>
                </span>
              </a>
            </li>

            
            <li>
              <a href="<?php echo base_url().'pegawai'?>">
                <i class="fa fa-server" aria-hidden="true"></i>
                <span>Pegawai</span>
                <span class="pull-right-container">
                  <small class="label pull-right"></small>
                </span>
              </a>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-user"></i>
                <span>Kesiswaan</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url().'siswa'?>"><i class="fa fa-users"></i> Data Siswa</a></li>
                <li><a href="<?php echo base_url().'siswa_keluar'?>"><i class="fa fa-star-o"></i> PD Keluar</a></li>
              </ul>
            </li>


            <li class="treeview active">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>E-Raport</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url().'mapel'?>"><i class="fa fa-list-ol"></i> Mapel</a></li>
                <li class="active"><a href="<?php echo base_url().'nilai_raport'?>"><i class="fa fa-sort-numeric-asc"></i> Nilai Raport</a></li>
              </ul>
            </li>

            <li>
              <a href="<?php echo base_url().'kisikisi'?>">
                <i class="fa fa-file-text"></i> <span>Kisi-Kisi</span>
                <span class="pull-right-container">
                  <small class="label pull-right bg-green"></small>
                </span>
              </a>
            </li>

            <li>
              <a href="<?php echo base_url().'keuangan'?>">
                <i class="fa fa-money"></i> <span>Keuangan</span>
                <span class="pull-right-container">
                  <small class="label pull-right bg-green"></small>
                </span>
              </a>
            </li>


            <?php else: ?>

              <li class="active">
                <a href="<?php echo base_url().'dashboard-siswa'?>">
                  <i class="fa fa-home"></i> <span>Dashboard</span>
                  <span class="pull-right-container">
                    <small class="label pull-right"></small>
                  </span>
                </a>
              </li>

              <li>
                <a href="<?php echo base_url().'keuangan-siswa'?>">
                  <i class="fa fa-calendar"></i> <span>Keuangan</span>
                  <span class="pull-right-container">
                    <small class="label pull-right"></small>
                  </span>
                </a>
              </li>


              <li>
                <a href="<?php echo base_url().'kisikisi'?>">
                  <i class="fa fa-calendar"></i> <span>Kisi - Kisi</span>
                  <span class="pull-right-container">
                    <small class="label pull-right"></small>
                  </span>
                </a>
              </li>

              <li>
                <a href="#">
                  <i class="fa fa-calendar"></i> <span>Evaluasi</span>
                  <span class="pull-right-container">
                    <small class="label pull-right"></small>
                  </span>
                </a>
              </li>

            <?php endif ?>
            <li >
              <a href="<?php echo base_url().'login/logout'?>" >
                <i class="fa fa-sign-out"></i> <span>Sign Out</span>
                <span class="pull-right-container">
                  <small class="label pull-right"></small>
                </span>
              </a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Input Nilai Pelajaran
         </h1>
         <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">E-Raport</li>
          <li class="active">List Siswa</li>
          <li class="active">Input Nilai</li>
        </ol>
      </section>

      <!-- Main content -->
            <section class="content">
        <?php $this->db->select('*')->from('tbl_siswa a')->join('tbl_kelas b', 'a.siswa_kelas_id = b.kelas_id', 'inner')->where(['a.siswa_nis' => $nis]);
        $siswa = $this->db->get()->row_array(); ?>
        <!-- FORM NAMA SISWA -->
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="row" style="padding: 10px">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-4 control-label">Nama Sekolah</label>
                    <div class="col-sm-6">
                      <label class="control-label">PKBM Anak Panah</label>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-4 control-label">Alamat</label>
                    <div class="col-sm-6">
                      <label class="control-label"><?= $siswa['siswa_alamat'] ?></label>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-4 control-label">Nama Peserta Didik</label>
                    <div class="col-sm-6">
                      <label class="control-label"><?= $siswa['siswa_nama'] ?></label>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-4 control-label">NIS/NISN</label>
                    <div class="col-sm-6">
                      <label class="control-label"><?= $siswa['siswa_nis'].'/'.$siswa['siswa_nisn'] ?></label>
                    </div>
                  </div>

                </div>
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 control-label">Kelas</label>
                    <div class="col-sm-3">
                      <label class="control-label"><?= $siswa['kelas_nama'] ?></label>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 control-label">Semester</label>
                    <div class="col-sm-3">
                      <label class="control-label"><?= $sms ?> <?= $sms == 1 ? "(Satu)" : "(Dua)" ?></label>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 control-label">Tahun Ajaran</label>
                    <div class="col-sm-3">
                      <label class="control-label"><?= $ta ?></label>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- START FORM -->

            <form action="<?= site_url('nilai_raport/save_raport') ?>" method="post" autocomplate="off">
              <input type="hidden" name="xnis" value="<?= $nis ?>">
              <input type="hidden" name="xta" value="<?= $ta ?>">
              <input type="hidden" name="xsms" value="<?= $sms ?>">
              <input type="hidden" name="xkls" value="<?= $siswa['siswa_kelas_id'] ?>">
              <div class="box">
                <div class="row" style="padding: 10px">
                  <!-- INPUT NILAI -->
                  <div class="col-md-6">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Mata Pelajaran</th>
                          <th>Nilai</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no = 1;
                        $mapel = $this->db->select('c.*')->from('tbl_pelajaran a')->join('tbl_kelas b', 'a.id_kelas = b.kelas_id', 'left')->join('tbl_mapel c', 'a.kd_mapel = c.kd_mapel', 'left')->where(['c.status_mapel' => '1', 'id_kelas' => $siswa['kelas_id']])->get()->result_array();

                        foreach ($mapel as $mpl) {
                          $nilai = $this->db->get_where('tbl_nilai', ['nis_siswa' => $nis, 'ta' => $ta, 'semester' => $sms, 'kd_mapel' => $mpl['kd_mapel']])->row_array(); ?>
                          <tr>
                            <td><?= $no++ ?></td>
                            <td>
                              <input type="hidden" name="kd_mapel[]" class="form-control" value="<?= $mpl['kd_mapel'] ?>">
                              <?= $mpl['nm_mapel'] ?>
                            </td>
                            <td class="col-md-2"><input type="text" name="nilai_mapel[]" class="form-control" onkeypress="return checknumber()" maxlength="3" value="<?= !empty($nilai['nilai']) ? $nilai['nilai'] : '' ?>"></td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>

                  <div class="col-md-6">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Kegiatan Pengembangan Diri</th>
                          <th>Nilai</th>
                        </tr>
                      </thead>
                      <tbody>
                       <?php $nilai_indv = $this->db->get_where('tbl_nilai_indv', ['nis_siswa' => $nis, 'ta' => $ta, 'semester' => $sms])->result_array(); ?>
                       <!--  <pre><?= var_dump($nilai_indv); ?></pre> -->
                       <?php for($i=0; $i<=2; $i++){ ?>
                        <tr>  
                         <td><?= ($i+1) ?></td>
                         <td>
                          <input type="hidden" name="datalama[]" value="<?= !empty($nilai_indv[$i]['kegiatan']) ? $nilai_indv[$i]['kegiatan'] : '' ?>">
                          <input type="text" name="val_indv[]" class="form-control" value="<?= !empty($nilai_indv[$i]['kegiatan']) ? $nilai_indv[$i]['kegiatan'] : '' ?>"></td>
                          <td class="col-md-2"><input type="text" name="nilai_indv[]" class="form-control" onkeypress="return checknumber()" maxlength="3" value="<?= !empty($nilai_indv[$i]['nilai']) ? $nilai_indv[$i]['nilai'] : '' ?>"></td>
                        </tr>                      
                      <?php }?>
                    </tbody>
                  </table>
                  <?php $absensi = $this->db->get_where('tbl_absensi', ['nis_siswa' => $nis, 'ta' => $ta, 'semester' => $sms])->row_array(); ?>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Absensi</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="col-md-1">1</td>
                        <td>Sakit</td>
                        <td class="col-md-2">
                          <input type="text" class="form-control" name="sakit" onkeypress="return checknumber()" maxlength="3" value="<?= empty($absensi['sakit']) ? '' : $absensi['sakit'] ?>">
                        </td>
                      </tr>
                      <tr>
                        <td class="col-md-1">2</td>
                        <td>Izin</td>
                        <td class="col-md-2">
                          <input type="text" class="form-control" name="izin" onkeypress="return checknumber()" maxlength="3" value="<?= empty($absensi['izin']) ? '' : $absensi['izin'] ?>">
                        </td>
                      </tr>
                      <tr>
                        <td class="col-md-1">3</td>
                        <td>Tanpa Keterangan</td>
                        <td class="col-md-2">
                          <input type="text" class="form-control" name="tanpaket" onkeypress="return checknumber()" maxlength="3" value="<?= empty($absensi['tanpa_ket']) ? '' : $absensi['tanpa_ket'] ?>">
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>


            <?php $data = $this->db->get_where('tbl_catmur', ['nis_siswa' => $nis, 'ta' => $ta, 'Semester' => $sms])->row_array();
            if(!empty($data)){
              $note = $data['catatan_siswa'];
            } else {
              $note = '';
            } ?>
            <div class="box">
              <div class="row" style="padding: 10px">
                <div class="col-md-6">
                 <?php $catpen = $this->db->get_where('tbl_catpenting', ['nis_siswa' => $nis, 'ta' => $ta, 'sms' => $sms])->row_array(); ?>
                 <label class="control-label">Catatan Penting Penilaian</label>
                 <table class="table">
                  <tbody>
                    <tr>
                      <td class="col-md-1">1</td>
                      <td>Budi Pekerti  / Sikap </td>
                      <td class="col-md-2">
                        <input type="text" class="form-control" name="sikap" onkeypress="return checknumber()" maxlength="3" value="<?= empty($catpen['sikap']) ? '' : $catpen['sikap'] ?>">
                      </td>
                    </tr>
                    <tr>
                      <td class="col-md-1">2</td>
                      <td>Partisipasi Kelas / Kegiatan</td>
                      <td class="col-md-2">
                        <input type="text" class="form-control" name="kegiatan" onkeypress="return checknumber()" maxlength="3" value="<?= empty($catpen['kegiatan']) ? '' : $catpen['kegiatan'] ?>">
                      </td>
                    </tr>
                    <tr>
                      <td class="col-md-1">3</td>
                      <td>Penyelesaian Tugas </td>
                      <td class="col-md-2">
                        <input type="text" class="form-control" name="tugas" onkeypress="return checknumber()" maxlength="3" value="<?= empty($catpen['tugas']) ? '' : $catpen['tugas'] ?>">
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-md-6">
                <label class="control-label">Catatan</label>
                <textarea name="note" cols="30" rows="5" class="form-control"><?= $note ?></textarea>
                <center><button class="btn btn-success" style="margin-top: 10px; width: 150px">Submit</button></center>
              </div>
            </div>
          </div>
        </form>
        <!-- END OF FORM -->
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 1.0
  </div>
  <strong>Copyright &copy; 2020 <a href="#">PKBM Anak Panah</a>.</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
    <script src="<?php echo base_url().'assets/plugins/jQuery/jquery-2.2.3.min.js'?>"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo base_url().'assets/bootstrap/js/bootstrap.min.js'?>"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url().'assets/plugins/datatables/jquery.dataTables.min.js'?>"></script>
    <script src="<?php echo base_url().'assets/plugins/datatables/dataTables.bootstrap.min.js'?>"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url().'assets/plugins/slimScroll/jquery.slimscroll.min.js'?>"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url().'assets/plugins/fastclick/fastclick.js'?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url().'assets/dist/js/app.min.js'?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url().'assets/dist/js/demo.js'?>"></script>
    <script type="text/javascript" src="<?php echo base_url().'assets/plugins/toast/jquery.toast.min.js'?>"></script>

<script>
  $(document).ready(function(){
    $('.form-check-input').click(function(){
      var kelasId = $(this).data('kelas');
      var mapelId = $(this).data('mapel');

      $.ajax({
        url: "<?= base_url('mapel/save_mapel') ?>",
        type: 'post',
        data: {
          kelasId: kelasId,
          mapelId: mapelId
        },
        success: function(){
          document.location.href="<?= site_url('mapel/setting_mapel').'/' ?>"+kelasId;
        }
      });
    });
  });

  function checknumber(){
   return event.keyCode >= 48 && event.keyCode <= 57 ;
 }
</script>

</body>
</html>
