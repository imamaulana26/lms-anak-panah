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
<?php 
if ($c['pengguna_level']==1) {
  $url=base_url().'dashboard';
  header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
  exit();
          // die();
};
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SEKOLAH ANAK PANAH | Kisi-Kisi Siswa</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="shorcut icon" type="text/css" href="<?php echo base_url().'assets/images/favicon.png'?>">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/bootstrap/css/bootstrap.min.css'?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css'?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/plugins/datatables/dataTables.bootstrap.css'?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/AdminLTE.min.css'?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
   <link rel="stylesheet" href="<?php echo base_url().'assets/dist/css/skins/_all-skins.min.css'?>">
   <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/plugins/toast/jquery.toast.min.css'?>"/>



 </head>
 <body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
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

          <li class="active">
            <a href="<?php echo base_url().'dashboard-admin'?>">
              <i class="fa fa-home"></i> <span>Dashboard</span>
              <span class="pull-right-container">
                <small class="label pull-right"></small>
              </span>
            </a>
          </li>


          <li class="treeview">
            <a href="#">
              <i class="fa fa-university"></i>
              <span>Lembaga</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url().'datalembaga'?>"><i class="fa fa-clone"></i> Data Lembaga</a></li>
              <li><a href="<?php echo base_url().'yayasan'?>"><i class="fa fa-building-o"></i> Yayasan</a></li>
              <li><a href="<?php echo base_url().'periodik'?>"><i class="fa fa-picture-o"></i> Periodik</a></li>
              <li><a href="<?php echo base_url().'bantuan'?>"><i class="fa fa-money"></i> Bantuan</a></li>
              <li><a href="<?php echo base_url().'layanan'?>"><i class="fa fa-picture-o"></i> Layanan</a></li>
            </ul>
          </li>

          <li>
            <a href="#">
              <i class="fa fa-users"></i> <span>Sarana Prasarana</span>
              <span class="pull-right-container">
                <small class="label pull-right"></small>
              </span>
            </a>
          </li>

          <li>
            <li class="treeview" >
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Pendidik/Tendik (PTK)</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url().'guru'?>"><i class="fa fa-clone"></i> PTK</a></li>
                <li><a href="<?php echo base_url().'galeri'?>"><i class="fa fa-picture-o"></i> PTK Keluar</a></li>
              </ul>
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
          </li>

          <li>
            <a href="<?php echo base_url().'rombel'?>">
              <i class="fa fa-calendar"></i> <span>Rombongan Belajar</span>
              <span class="pull-right-container">
                <small class="label pull-right"></small>
              </span>
            </a>
          </li>

          <li class="treeview">
            <a href="#">
              <i class="fa fa-users"></i>
              <span>Evaluasi</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo base_url().'guru'?>"><i class="fa fa-clone"></i> Raport Sebelumnya</a></li>
              <li><a href="<?php echo base_url().'evaluasi'?>"><i class="fa fa-picture-o"></i> Evaluasi</a></li>
            </ul>
          </li>

          <li>
            <a href="<?php echo base_url().'alumni'?>">
              <i class="fa fa-volume-up"></i> <span>Alumni</span>
              <span class="pull-right-container">
                <small class="label pull-right"></small>
              </span>
            </a>
          </li>

          <li >
            <a href="<?php echo base_url().'instrumen'?>">
              <i class="fa fa-envelope"></i> <span>Instrumen</span>
              <span class="pull-right-container">
                <small class="label pull-right bg-green"></small>
              </span>
            </a>
          </li>

          <li>
            <a href="<?php echo base_url().'keuangan'?>">
              <i class="fa fa-envelope"></i> <span>Keuangan</span>
              <span class="pull-right-container">
                <small class="label pull-right bg-green"></small>
              </span>
            </a>
          </li>


          <?php else: ?>

            <li>
              <a href="<?php echo base_url().'dashboard'?>">
                <i class="fa fa-home"></i> <span>Dashboard</span>
                <span class="pull-right-container">
                  <small class="label pull-right"></small>
                </span>
              </a>
            </li>

            <li>
              <a href="<?php echo base_url().'biodata'?>">
                <i class="fa fa-newspaper-o"></i> <span>Biodata</span>
                <span class="pull-right-container">
                  <small class="label pull-right"></small>
                </span>
              </a>
            </li>

            <li>
              <a href="<?php echo base_url().'keuangan_siswa'?>">
                <i class="fa fa-money"></i> <span>Keuangan</span>
                <span class="pull-right-container">
                  <small class="label pull-right"></small>
                </span>
              </a>
            </li>


            <li class="active">
              <a href="<?php echo base_url().'kisikisi'?>">
                <i class="fa fa-file-text"></i> <span>Kisi - Kisi</span>
                <span class="pull-right-container">
                  <small class="label pull-right"></small>
                </span>
              </a>
            </li>

            <li>
              <a href="<?php echo base_url().'evaluasi'?>">
                <i class="fa fa-files-o"></i> <span>Evaluasi</span>
                <span class="pull-right-container">
                  <small class="label pull-right"></small>
                </span>
              </a>
            </li>

            <li>
              <a href="<?php echo base_url().'inbox'?>">
                <i class="fa fa-envelope-o"></i> <span>Inbox</span>
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
          Kisi-Kisi
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Kisi-Kisi</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <?php
              $id_admin=$this->session->userdata('idadmin');

              $c = $this->db->select('*')->from('tbl_pengguna a')->join('tbl_siswa b', 'a.pengguna_username = b.siswa_nis', 'inner')->join('tbl_kelas c', 'b.siswa_kelas_id = c.kelas_id', 'inner')->join('tbl_orangtua d', 'b.siswa_nis = d.siswa_nis', 'inner')->join('tbl_agama e', 'b.siswa_agama_id = e.agama_id', 'inner')->where(['a.pengguna_id' => $id_admin])->get()->row_array();
              $user = $this->session->set_userdata(['user' => $c['siswa_nis']]);
              ?>
              <?php  
              $kelas=$c['siswa_kelas_id'];
                // $kelas=$c['siswa_kelas_id'];
              $data = $this->db->select('*')->from('tbl_kisikisi a')->join('tbl_mapel b', 'a.kisikisi_mapel = b.kd_mapel', 'inner')->join('tbl_kelas c', 'a.kisikisi_kelas_id = c.kelas_id', 'inner')->where(['a.kisikisi_kelas_id' => $kelas])->order_by('a.kisikisi_semester', 'asc')->get()->result_array();
              ?>
              <div class="box-header">
                <div class="box-body">
                 <table id="table" class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Mata Pelajaran</th>
                      <th>Semester</th>
                      <th>Ulangan Bulanan</th>
                      <th>Kisi-Kisi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no = 1;
                    $sisa = 0;
                    foreach ($data as $dt) { ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?=  $dt['nm_mapel'] ?></td>
                        <td><?=  $dt['kisikisi_semester'] ?></td>
                        <td>UB <?=  $dt['kisikisi_ub'] ?></td>
                        <td><?=  $dt['kisikisi_deskripsi'] ?></td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- /.content -->

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
<!-- page script -->
<script>
  $(document).ready(function(){
    $('#table').DataTable();
  });
        $(function () {
          $("#example1").DataTable();
          $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
          });
        });
      </script>
      <?php if($this->session->flashdata('msg')=='error'):?>
        <script type="text/javascript">
          $.toast({
            heading: 'Error',
            text: "Password dan Ulangi Password yang Anda masukan tidak sama.",
            showHideTransition: 'slide',
            icon: 'error',
            hideAfter: false,
            position: 'bottom-right',
            bgColor: '#FF4859'
          });
        </script>

        <?php elseif($this->session->flashdata('msg')=='success'):?>
          <script type="text/javascript">
            $.toast({
              heading: 'Success',
              text: "Siswa Berhasil disimpan ke database.",
              showHideTransition: 'slide',
              icon: 'success',
              hideAfter: false,
              position: 'bottom-right',
              bgColor: '#7EC857'
            });
          </script>
          <?php elseif($this->session->flashdata('msg')=='info'):?>
            <script type="text/javascript">
              $.toast({
                heading: 'Info',
                text: "Siswa berhasil di update",
                showHideTransition: 'slide',
                icon: 'info',
                hideAfter: false,
                position: 'bottom-right',
                bgColor: '#00C9E6'
              });
            </script>
            <?php elseif($this->session->flashdata('msg')=='info_keluar'):?>
              <script type="text/javascript">
                $.toast({
                  heading: 'Info',
                  text: "Siswa berhasil di keluarkan",
                  showHideTransition: 'slide',
                  icon: 'info',
                  hideAfter: false,
                  position: 'bottom-right',
                  bgColor: '#00C9E6'
                });
              </script>
              <?php else:?>

              <?php endif;?>
            </body>
            </html>
