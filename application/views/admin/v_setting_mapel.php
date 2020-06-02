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
  <title>SEKOLAH ANAK PANAH | Seting Mapel</title>
  <!-- Tell the browser to be responsive to screen width -->
  <link rel="shorcut icon" type="text/css" href="<?php echo base_url().'assets/images/favicon.png'?>">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/bootstrap/css/bootstrap.min.css'?>">
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
                <li class="active"><a href="<?php echo base_url().'mapel'?>"><i class="fa fa-list-ol"></i> Mapel</a></li>
                <li><a href="<?php echo base_url().'nilai_raport'?>"><i class="fa fa-sort-numeric-asc"></i> Nilai Raport</a></li>
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
            Pilih Mata Pelajaran <?= $kelas['kelas_nama'] ?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">E-Raport</li>
            <li class="active">Mapel</li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <a href="<?= site_url('mapel') ?>" class="btn btn-primary" style="margin-bottom: 10px"><i class="fa fa-fw fa-chevron-left"></i> Back</a>
          <!-- <a href="<?= site_url('mapel/tambah_mapel') ?>" class="btn btn-primary" style="margin-bottom: 10px" ><i class="fa fa-fw fa-plus"></i> Tambah</a> -->
          <div class="row">
            <div class="col-md-6">
              <?php if(!empty($this->session->flashdata('info'))){ ?>
                <div class="alert alert-info alert-dismissible">
                  <span class="close" data-dismiss="alert">&times;</span>
                  <strong><?= $this->session->flashdata('info') ?></strong>
                </div>
              <?php } ?>

              <table class="table" border="1px">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Mata Pelajaran</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1;
                  foreach ($mapel as $mpl) { ?>
                    <tr>
                      <td width="5%"><?= $no++ ?></td>
                      <td><?= $mpl['nm_mapel'] ?></td>
                      <td width="5%" class="text-center">
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" <?= check($kelas['kelas_id'], $mpl['kd_mapel']); ?> data-kelas="<?= $kelas['kelas_id'] ?>" data-mapel="<?= $mpl['kd_mapel'] ?>">
                        </div>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
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
    </script>

  </body>
  </html>
